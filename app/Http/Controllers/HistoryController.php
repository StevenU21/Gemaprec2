<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Activity::latest()->paginate(5);

        foreach ($histories as $history) {
            $changes = json_decode($history->changes(), true);
            $old = $changes['old'] ?? [];
            $attributes = $changes['attributes'] ?? [];

            $history->old = $old;
            $history->new = $attributes;
        }

        return view('histories.index', compact('histories'));
    }

    public function arrayToString($array)
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result[] = $this->arrayToString($value);
            } else {
                $result[] = "$key: $value";
            }
        }
        return implode(', ', $result);
    }
}
