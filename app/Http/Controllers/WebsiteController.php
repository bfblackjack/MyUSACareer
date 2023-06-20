<?php

namespace App\Http\Controllers;

use App\Enums\Jobs2CareersClassificationEnum;
use App\Models\Newsletter;
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

        $apikey = config('services.job_apis.jobs2careers.key');
        $apipass = config('services.job_apis.jobs2careers.pass');
        $url = 'https://api.jobs2careers.com/api/search.php?id=' . $apikey . '&pass=' . $apipass . '&format=json&link=1&logo=1&ip=' . $user_ip . '&q='.$str.'&l=' . $location;
        $url .= '&salary.period=yearly&salary.min='.$randSalaryMin.'&salary.max='.$randSalaryMax;

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

        return inertia()->render('Jobs')->with([
            'jobs' => null,
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

    public function directJob() {
        $str = 'Online Tutor, Construction worker, Electrician, Plumber, Welder, Carpenter, Mason, Roofer, Landscaper, Painter, Automotive technician, HVAC technician, Ironworker, Truck driver, Concrete finisher, Glass installer, Elevator mechanic, Forklift operator, Tile setter, Drywall installer, Insulation installer, Cabinet maker, Floor installer, Painter, Crane operator, Plasterer, Automotive mechanic, Millwright, Steelworker, Bridge painter, Industrial painter, Bricklayer, Pile driver operator, Concrete saw cutter, Demolition worker, Glassblower, Plasterer, Quarry worker, Shipyard worker, Stucco mason, Tiler, Water well driller, Bricklayer, Foundry worker,Intern,Holiday,Co Op,Permanent,Professional,Helper,Second,Director,Day,Mobile,Statewide,Intermediate,Leader,Floater,Regional,On Call,National,Before School,VP,Support,Locum Tenens,Without Experience,Dedicated,Internal,Head Of,Territory,Junior,Long Term,Critical,Hourly Shift,Senior Specialist,Before and After School,For Students';

    }
}
