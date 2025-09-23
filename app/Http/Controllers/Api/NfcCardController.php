<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NfcCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NfcCardController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'uid' => 'required|string'
        ]);

        $card = NfcCard::where('uid', $request->uid)->first();

        if (!$card) {
            return response()->json(['message' => 'Kartu tidak dikenali'], 404);
        }

        return response()->json([
            'message' => 'Kartu valid',
            'card' => $card,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|string|unique:nfc_cards,uid',
            'id_isc' => 'required|exists:mahasiswa,id_isc',

        ]);

        $card = NfcCard::create([
            'uid' => $request->uid,
            'id_isc' => $request->id_isc,
        ]);

        return response()->json([
            'message' => 'Kartu berhasil ditambahkan.',
            'card' => $card,
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = NfcCard::where('uid', $request->uid)->first();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'token' => $token
        ], 200);
    }
}
