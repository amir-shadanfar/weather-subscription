<?php

namespace App\Http\Controllers;

use App\GiftCode;
use App\Http\Middleware\ApiAuthMiddleware;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SystemController extends Controller
{

    public function __construct()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activeGiftCode(Request $request)
    {
        try {
            $giftCodeRecord = GiftCode::where('code', $request->code)->where('expired_date', '>=', Carbon::now())->first();
            if (!is_null($giftCodeRecord)) {
                User::where('id', ApiAuthMiddleware::getId())->update([
                    'gift_code_id' => $giftCodeRecord->id
                ]);
                return response()->json(['message' => 'Gift code activated'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
