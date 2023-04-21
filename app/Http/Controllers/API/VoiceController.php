<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PhoneVoicemail;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class VoiceController extends Controller
{
    public function inboundVoicemail(Request $request) {
        $callSid = $request->CallSid;
        $recordingSid = $request->RecordingSid;
        $recordingUrl = $request->RecordingUrl;
        $recordingStatus = $request->RecordingStatus;
        $duration = $request->RecordingDuration;

        if($recordingStatus === "completed") {
            $fileName = 'voicemails/' . $callSid . '.wav';
            Storage::disk('voicemails')->put($fileName, file_get_contents($recordingUrl));

//            $voicemail = new PhoneVoicemail();
//            $voicemail->path = $fileName;
//            $voicemail->recording_sid = $recordingSid;
//            $voicemail->call_sid = $callSid;
//            $voicemail->durationSeconds = $duration;
//            $voicemail->save();
//
//            try {
//                $twilio = new Client(config('twilio.sid'), config('twilio.token'));
//                $twilio->recordings($recordingSid)->delete();
//            } catch(TwilioException $e) {
//                Bugsnag::notifyException($e);
//            } catch(\Exception $e) {
//                Bugsnag::notifyException($e);
//            }
        }

        return response()->json(['status' => 'success'])->setStatusCode(200);
    }
}
