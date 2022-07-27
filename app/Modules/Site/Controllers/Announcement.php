<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OffersNotification;
use App\Models\User;
class Announcement extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    public function sendOfferNotification() {
        $userSchema = User::find(auth()->user()->id);

        $offerData = [
            'title' => 'BOGO',
        ];

        Notification::send($userSchema, new OffersNotification($offerData));

        //dd('Task completed!');
    }
}
