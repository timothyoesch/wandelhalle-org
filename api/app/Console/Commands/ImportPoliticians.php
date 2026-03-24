<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Canton;
use App\Models\Council;
use App\Models\Mandate;
use App\Models\Party;
use App\Models\Politician;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

#[Signature('import:politicians {filepath}')]
#[Description('Import politicians from a CSV file')]
class ImportPoliticians extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filepath = $this->argument('filepath');

        if (!file_exists($filepath)) {
            $this->error("File not found at path: {$filepath}");
            return Command::FAILURE;
        }

        $file = fopen($filepath, 'r');
        $headers = fgetcsv($file);

        $this->info('Starting import...');
        $successCount = 0;
        $skipCount = 0;

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($headers, $row);

            $firstName = trim($data['FirstName']);
            $lastName = trim($data['LastName']);
            $fullName = "{$firstName} {$lastName}";

            // 1. Strict Lookups
            // Canton and Council match directly on the 'abbreviation' column
            $canton = Canton::where('abbreviation', $data['Canton'])->first();
            $council = Council::where('abbreviation', $data['Council Abbreviation'])->first();

            // Party matches the German ('de') key inside the Spatie JSON abbreviation column
            $party = Party::where('abbreviation->de', $data['PartyAbbreviation'])->first();

            // Safety Check: If any seeded data is missing, skip and log it.
            if (!$canton || !$council || !$party) {
                $missing = [];
                if (!$canton) $missing[] = "Canton ({$data['Canton']})";
                if (!$council) $missing[] = "Council ({$data['Council Abbreviation']})";
                if (!$party) $missing[] = "Party ({$data['PartyAbbreviation']})";

                $this->warn("Skipping {$fullName}: Missing " . implode(', ', $missing));
                $skipCount++;
                continue;
            }

            $slug = Str::slug($fullName);
            $avatarPath = null;
            $remoteImageUrl = $data['Avatar URL'];

            if (!empty($remoteImageUrl)) {
                // Extract the extension (usually .jpg)
                $extension = pathinfo($remoteImageUrl, PATHINFO_EXTENSION) ?: 'jpg';
                $originalFilename = pathinfo($remoteImageUrl, PATHINFO_FILENAME);
                $filename = "avatars/{$slug}-{$originalFilename}.{$extension}";

                // Check if we already downloaded it in a previous run
                if (!Storage::disk('public')->exists($filename)) {
                    try {
                        $response = Http::timeout(10)->get($remoteImageUrl);
                        if ($response->successful()) {
                            Storage::disk('public')->put($filename, $response->body());
                            $avatarPath = config("app.url") . "/storage/" . $filename; // e.g., 'avatars/alex-farinelli.jpg'
                        } else {
                            $this->warn("Failed to download image for {$fullName}");
                        }
                    } catch (\Exception $e) {
                        $this->warn("Error downloading image for {$fullName}: " . $e->getMessage());
                    }
                } else {
                    $avatarPath = config("app.url") . "/storage/" . $filename; // Already exists
                }
            }

            // 2. Create or Update the Politician
            $politician = Politician::updateOrCreate(
                ['slug' => Str::slug($fullName)],
                [
                    'name' => $fullName,
                    'canton_id' => $canton->id,
                    'avatar_url' => $avatarPath,
                ]
            );

            // 3. Sync the Mandate
            $startDate = Carbon::parse($data['Mandate Start'])->format('Y-m-d');

            Mandate::firstOrCreate(
                [
                    'politician_id' => $politician->id,
                    'council_id' => $council->id,
                    'party_id' => $party->id,
                ],
                [
                    'type' => 'elected',
                    'start_date' => $startDate,
                    'is_active' => true,
                ]
            );

            $successCount++;
        }

        fclose($file);

        $this->info("Import complete!");
        $this->info("Successfully imported/updated: {$successCount}");
        if ($skipCount > 0) {
            $this->warn("Skipped rows: {$skipCount}");
        }

        return Command::SUCCESS;
    }
}
