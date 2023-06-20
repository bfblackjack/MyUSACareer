<?php

namespace App\Http\Controllers;

use App\Enums\Jobs2CareersClassificationEnum;
use App\Models\Newsletter;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebsiteController extends Controller
{
    public function index(Request $request) {
        if(config('app.env') === 'local') {
            $user_ip = '170.55.182.130';
        }
        else {
            $user_ip = $request->ip();
        }
        if($request->has('location') && !empty($request->location))
            $location = $request->location;
        else {
            $details = json_decode(file_get_contents("https://ipapi.co/$user_ip/json/?key=".config('services.ip_key')));
            if(isset($details->city)) {
                $location = $details->city;
            }
            else {
                $location = "remote";
            }
        }

        $str = "remote,work from home";
        $arr = explode(",", $str);
        $randomKey = array_rand($arr);

        $query = $arr[$randomKey];

        $randSalaryMin = random_int(30000, 45000);
        $randSalaryMax = random_int(38000,75000);

        $apikey = config('services.job_apis.jobs2careers.key');
        $apipass = config('services.job_apis.jobs2careers.pass');
        $url = 'https://api.jobs2careers.com/api/search.php?id=' . $apikey . '&pass=' . $apipass . '&format=json&link=1&logo=1&ip=' . $user_ip . '&q='.$str.'&l=' . $location;
        $url .= '&salary.period=yearly&salary.min='.$randSalaryMin.'&salary.max='.$randSalaryMax;

        $res = \Http::withHeaders([
            'Content-Type: application/json'
        ])->post($url);

        $body = json_decode($res->body());

        return inertia()->render('Welcome')->with([
            'jobs' => $body
        ]);
    }

    public function jobs(Request $request) {
        if(config('app.env') === 'local') {
            $user_ip = '170.55.182.130';
        }
        else {
            $user_ip = $request->ip();
        }
        if($request->has('location') && !empty($request->location))
            $location = $request->location;
        else {
            $details = json_decode(file_get_contents("https://ipapi.co/$user_ip/json/?key=".config('services.ip_key')));
            if(isset($details->city)) {
                $location = $details->city;
            }
            else {
                $location = "remote";
            }
        }

        $randSalaryMin = random_int(30000, 45000);
        $randSalaryMax = random_int(38000,75000);

        if($request->has('job') && !empty($request->job)) {
            $query = $request->job;
        }
        elseif(!empty($term)) {
            $query = $term;
            $request->job = $term;
        }
        else {
            $str = "remote,work from home";
            $arr = explode(",", $str);

            $randomKey = array_rand($arr);

            $query = $arr[$randomKey];
        }

        $apikey = config('services.job_apis.jobs2careers.key');
        $apipass = config('services.job_apis.jobs2careers.pass');
        $url = 'https://api.jobs2careers.com/api/search.php?id=' . $apikey . '&pass=' . $apipass . '&format=json&link=1&logo=1&ip=' . $user_ip . '&q=' . $query . '&l=' . $location;

        if($request->has('type')) {
            if($request->type !== "All Categories") {
                $catId = Jobs2CareersClassificationEnum::tryFromName(str_replace(' ', '', $request->type));
                $url .= '&major_category=' . $catId->value;
            }
        }

        if($request->has('experience') && !empty($request->experience)) {
            $expType = match ($request->experience) {
                "None" => 2,
                "Senior" => 3,
                "Manager" => 4,
                "Executive" => 5,
            };

            $url .= "&experience={$expType}";
        }

        if($request->has('employment_type') && !empty($request->employment_type)) {
            $worktype = Str::lower(str_replace(' ', '', $request->employment_type));
            $url .= "&worktype={$worktype}";
        }
        if($request->has('salary') && !empty($request->salary)) {
            $salary = preg_replace('/[^0-9]/', '', $request->salary);

            $url .= "&salary.period=yearly&salary.min={$salary}";
        }

        $j2cCatEnums = Jobs2CareersClassificationEnum::cases();
        $categories = [
            'All Categories'
        ];
        foreach($j2cCatEnums as $catEnum) {
            $categories[] = Str::headline($catEnum->name);
        }

        $res = \Http::withHeaders([
            'Content-Type: application/json'
        ])->post($url);

        $body = json_decode($res->body());

        return inertia()->render('Jobs')->with([
            'jobs' => $body,
            'categories' => $categories,
            'location' => $location,
            'type' => 'All Categories',
            'job' => $query,
            'employment_type' => $request->employment_type,
            'experience' => $request->experience,
            'salary' => $request->salary,
        ]);
    }

    public function about() {
        return inertia()->render('About');
    }

    public function contact() {
        return inertia()->render('Contact');
    }

    public function privacyPolicy() {
        return inertia()->render('Privacy');
    }

    public function subscribeToNewsLetter(Request $request) {
        $request->validate([
            'email' => 'required|email:rfc,dns'
        ]);

        Newsletter::create(['email' => $request->email]);

        return redirect()->back();
    }

    public function directJob(Request $request) {
        if(config('app.env') === 'local') {
            $user_ip = '170.55.182.130';
        }
        else {
            $user_ip = $request->ip();
        }

        if($request->has('location') && !empty($request->location)) {
            $location = $request->location;
            $details = [
                'passed_location' => $location,
            ];
        }
        else {
            try {
                $details = json_decode(file_get_contents("https://ipapi.co/$user_ip/json/?key=".config('services.ip_key')));

                if (isset($details->city)) {
                    $location = $details->city;
                } else {
                    $location = "remote";
                }
            }
            catch(\Exception $e) {
                \Log::error('IP INFO TOO MANY REQUESTS', ['msg' => $e->getMessage()]);
                $details = ['error' => $e->getMessage()];

                $location = "remote";
            }
        }

        // User Agents
        $rand = rand(0, 100);
        if($rand >= 25) {
            $userAgents = [
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/600.8.9 (KHTML, like Gecko) Version/8.0.8 Safari/600.8.9',
                'Mozilla/5.0 (iPad; CPU OS 8_4_1 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12H321 Safari/600.1.4',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/600.7.12 (KHTML, like Gecko) Version/8.0.7 Safari/600.7.12',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/600.8.9 (KHTML, like Gecko) Version/7.1.8 Safari/537.85.17',
                'Mozilla/5.0 (iPad; CPU OS 8_4 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12H143 Safari/600.1.4',
                'Mozilla/5.0 (iPad; CPU OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12F69 Safari/600.1.4',
                'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.0; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36'
            ];

            $randomAgentIndex = array_rand($userAgents);

            $userAgent = $userAgents[$randomAgentIndex];
        }
        else {
            $userAgent = $request->header('User-Agent');
        }

        $str = 'Online Tutor, Construction worker, Electrician, Plumber, Welder, Carpenter, Mason, Roofer, Landscaper, Painter, Automotive technician, HVAC technician, Ironworker, Truck driver, Concrete finisher, Glass installer, Elevator mechanic, Forklift operator, Tile setter, Drywall installer, Insulation installer, Cabinet maker, Floor installer, Painter, Crane operator, Plasterer, Automotive mechanic, Millwright, Steelworker, Bridge painter, Industrial painter, Bricklayer, Pile driver operator, Concrete saw cutter, Demolition worker, Glassblower, Plasterer, Quarry worker, Shipyard worker, Stucco mason, Tiler, Water well driller, Bricklayer, Foundry worker,Intern,Holiday,Co Op,Permanent,Professional,Helper,Second,Director,Day,Mobile,Statewide,Intermediate,Leader,Floater,Regional,On Call,National,Before School,VP,Support,Locum Tenens,Without Experience,Dedicated,Internal,Head Of,Territory,Junior,Long Term,Critical,Hourly Shift,Senior Specialist,Before and After School,For Students';
        $arr = explode(",", $str);
        $randomKey = array_rand($arr);

        $query = $arr[$randomKey];

        $weights = Partner::get();

        $rand = rand(1,100);
        $sum = 0;
        $selectedPartner = null;
        foreach($weights as $partner) {
            $sum += (int)$partner->weight;
            if($sum >= $rand) {
                $selectedPartner = $partner->partner;

                $outgoingAd = $partner->ads()->create([
                    'pct_threshold' => $sum,
                    'user_ip' => $user_ip,
                    'user_agent' => $userAgent,
                    'geo_city' => $location,
                    'geo_json' => $details,
                ]);

                break;
            }
        }

        if($selectedPartner === "Jobs 2 Careers") {
            $randSalaryMin = random_int(25000, 55000);
            $randSalaryMax = random_int(32000,82000);
            $apikey = config('services.job_apis.jobs2careers.key');
            $apipass = config('services.job_apis.jobs2careers.pass');
            $url = 'https://api.jobs2careers.com/api/search.php?id=' . $apikey . '&pass=' . $apipass . '&format=json&link=1&logo=1&ip=' . $user_ip . '&q=' . $query . '&l=' . $location;
            $url .= '&salary.period=yearly&salary.min='.$randSalaryMin.'&salary.max='.$randSalaryMax;

            $outgoingAd->ad_query()->create([
                'query' => 'query='.$query.'&salary.period=yearly&salary.min='.$randSalaryMin.'&salary.max='.$randSalaryMax,
            ]);

            $res = \Http::withUserAgent($userAgent)->withHeaders([
                'Content-Type: application/json'
            ])->post($url);

            $body = json_decode($res->body());

            $jobWeWant = $body->jobs[array_rand($body->jobs)];
            return redirect($jobWeWant->url);
        }

        return redirect()->to(route('home'));
    }
}
