<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb;
use Tmdb\Exception\TmdbApiException;

class PersonController extends Controller
{
    public function getPerson($id)
    {
        try {
            $apiKey = 'da477b9f4f22143fdb28a8742d537ec6';

            $token = new \Tmdb\ApiToken($apiKey);
            $client = new \Tmdb\Client($token);
            $repository = new \Tmdb\Repository\PeopleRepository($client);

            $person = $repository->load($id);
            $biography = $person->getBiography();
            $person = $repository->load($id, ['language' => 'pl']);

            $movieArray = [];

            foreach ($person->getMovieCredits()->getCast() as $movie) {
                array_push($movieArray, ['date' => $movie->getReleaseDate()->format('Y'), 'poster' => $movie->getPosterPath(),
                    'character' => $movie->getCharacter(), 'title' => $movie->getTitle(), 'id' => $movie->getId()]);
            }

            asort($movieArray);

            $tvShowArray = [];

            foreach ($person->getTvCredits()->getCast() as $movie) {
                array_push($tvShowArray, ['date' => strstr($movie->getFirstAirDate(), '-', true), 'poster' => $movie->getPosterPath(),
                    'character' => $movie->getCharacter(), 'title' => $movie->getName(), 'id' => $movie->getId()]);
            }

            asort($tvShowArray);

            $images = $person->getImages();

            return view('person', compact(
                'person',
                'movieArray',
                'biography',
                'tvShowArray',
                'images'
            ));
        }

        catch(TmdbApiException $e)
        {
            if (TmdbApiException::STATUS_RESOURCE_NOT_FOUND == $e->getCode())
            {
                notify()->flash('Nie znaleziono aktora', 'error', ['timer' => 1500]);
                return redirect()->back();

            }
        }
    }
}
