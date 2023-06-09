<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Quote;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $startTime = microtime(true); // start timer
        $timeStoredInSeconds = 3600;
        $quotes = Cache::remember('allQuotes', 3600, function() {
            return Quote::all();
        });
        $totalTime = microtime(true) - $startTime; // end timer
        return response()->json([
            'totalTime' => $totalTime,
            'quotes' => $quotes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuoteRequest $request)
    {
        $newQuote = Quote::create($request->all());

        return response()->json($newQuote);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        $quote = Quote::findOrFail($quote);
        return response()->json($quote);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuoteRequest  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuoteRequest $request, Quote $quote)
    {
        $updatedQuote = $request->all();
        $quote->update($updatedQuote);

        return response()->json($quote);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();

        return response()->json($quote::all());
    }
}
