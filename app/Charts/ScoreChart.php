<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Score;
use Carbon\Carbon;

class ScoreChart extends BaseChart
{
    public ?string $name = 'score_chart';
    public ?string $routeName = 'score_chart';
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $chart = Chartisan::build();
        $scores = Score::whereBetween('created_at', [Carbon::today()->sub('2 days'), Carbon::tomorrow()])->get();
        $labels = $scores->groupBy(function($score) { return Carbon::parse($score->created_at)->format('l'); })->keys()->all();
        $dataset = $scores->sortBy('value')->groupBy('value')->transform(function($item, $key) {
            return $item->groupBy(function($score) { return Carbon::parse($score->created_at)->format('l'); })
                ->map(function($i, $k) {
                    return $i->count();
                });
        });

        foreach($dataset as $key => $item) {
            $values = [];
            foreach($labels as $label) {
                array_push($values, $item[$label] ?? 0);
            }
            $chart->dataset((string)$key, $values);
        }

        info($dataset);
        $chart->labels($labels);
        return $chart;
    }
}