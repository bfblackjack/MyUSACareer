<?php

namespace App\Http\Controllers;

use App\Enums\Jobs2CareersClassificationEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebsiteController extends Controller
{
    public function index() {
        return inertia()->render('Welcome');
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
            $location = "remote";
        }

        if($request->has('job') && !empty($request->job)) {
            $query = $request->job;
        }
        elseif(!empty($term)) {
            $query = $term;
            $request->job = $term;
        }
        else {
            $str = 'Virtual Assistant,Welder,Flight Attendant,Box Truck Owner Operator,Video Game Tester,Phlebotomist,Online Tutor,Telemedicine Nurse Practitioner,Electrician Apprentice,Drone Pilot,Remote Medical Coder,Nanny,Cannabis Grower,Graphic Designer,Nurse Practitioner,Photographer,House Sitter,Medical Assistant,Sprinter Owner Operator,Game Tester,Telemedicine Physician,Delivery Independent Contractor,Hunter,Pharmacist,Dental Assistant,Personal Assistant,Homeworker,Home Workers,Home Worker,Work Home,Fashion Model,LPN Travel Assignment,Dog Walker,Freelance Writer,Administrative Assistant,Hands,Physical Therapy Assistant,Pickup Truck Owner,Pharmaceutical Sales Representative,FRAC Sand Owner Operator,Esthetician,Lineman Apprentice,Cannabis Trimmer,Pharmacy Technician,Occupational Therapy Assistant,Heavy Equipment Operator,Traveling CNA,Health Care Administrator,Dump Truck Owner Operator,Traveling Social Worker,Firefighter,Landman,Receptionist,Warehouse Worker,Part Times,Park Time,Social Worker,Physician Assistant,Video Editor,Mystery Shopper,Electrician,Traveling EMT,Brand Ambassador,Podiatrist,District Manager,Paralegal,Private Pilot,Local Truck Driver,Home Organizer,Mounter,Hotshot Driver,Pipeline Welder,Personal Shopper,Non CDL Driver,Helicopter Pilot,Telehealth Therapist,Independent Contractor Courier,Hair Model,Bookkeeper,Motivational Speaker,SLP Teletherapy,Crude Oil Owner Operator,Mechanical Engineer,Carpenter,Medical Delivery Driver,Independent Contractor,CDL Dedicated Truck Driver,Office Cleaner,Local Owner Operator Truck Driver,Class B Truck Driver,Interior Designer,Remotely,AWS Cloud Practitioner,Travel Radiologic Technologist,Utilization Review Physical Therapist,Petroleum Engineer,Acupuncturist,Life Coach,Regional Owner Operator Truck Driver,Lineman,Work From Home,Full Time,No Experience,Online,Part Time,Weekend,Entry Level,Telecommute,Virtual,Summer,Night Shift,Teen,Overnight,Freelance,Evening,Early Morning,Covid%2019,At Home,From Home,2nd Shift,Contract,Temporary,Internship,3rd Shift,Seasonal,Bilingual,General Labor,1st Shift,Temp,Per Diem,Night,Afterschool,Coronavirus,Immediate,Tutor,Service,Clerical,Skilled Labor,Salaried,Startup,Assistant,Administrative,Commission,Coronavirus (Covid%2019),Labor,Monday Friday,Desk,Trainee,Aide,Intern,Holiday,Co Op,Permanent,Professional,Helper,Second,Director,Day,Mobile,Statewide,Intermediate,Leader,Floater,Regional,On Call,National,Before School,VP,Support,Locum Tenens,Without Experience,Dedicated,Internal,Head Of,Territory,Junior,Long Term,Critical,Hourly Shift,Senior Specialist,Before and After School,For Students';
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
}
