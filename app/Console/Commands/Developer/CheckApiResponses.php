<?php

namespace App\Console\Commands\Developer;

use Illuminate\Console\Command;

class CheckApiResponses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-api-responses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // rand user ip proxy
        $user_ip = "73.43.143.245";

        $apikey = config('services.job_apis.jobs2careers.key');
        $apipass = config('services.job_apis.jobs2careers.pass');

        $location = "Douglasville";
        $query = "nurse practitioner";
        $url = 'https://api.jobs2careers.com/api/search.php?id=' . $apikey . '&pass=' . $apipass . '&format=json&link=1&logo=1&ip=' . $user_ip . '&q=' . $query . '&l=' . $location;

        $res = \Http::withHeaders([
            'Content-Type: application/json'
        ])->post($url);

        $this->info("TALROO: " . $res->status());
    }
}
