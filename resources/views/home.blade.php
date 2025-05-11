@extends('layouts.layout')
@section('body')
    
    @auth
        <h2>Welcome, {{ auth()->user()->name }}</h2>
    @else
        <h2>Welcome to Home page!</h2>

        
    @endauth
    <p></p>
    <p>
        Tagesgeschäft: <br>
        Beim Tagesgeschäft, muss ich die Produkte kaufen können. Wenn ich kaufe, gebe ich ein, was ich gekauft habe und den Preis dieses Produktes ein.
        <br>
        Tagesabschluss:<br>
        Am Ende des Tages, werden alle dieser Produkte beim Abschluss Fenster angezeigt. Ich muss dann diese Produkte einer Kostenstelle ausweisen. Am Schluss taucht eine Auswertung mit dem Budgetstand und dem erlaubten Menge auf. 

    </p>

    <p>
        <ul>
            <li>Benötigte Fenster:</li>
            <li>Stammdaten Erfassung:</li>
            <li>Kostenstellen:</li>
            <li>Name, Budget</li>
            <li>Kostenträger Erfassung:</li>
        </ul>
    </p>
@endsection