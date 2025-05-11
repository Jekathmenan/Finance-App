@extends('layouts.layout_tab')
@section('tabs')
    <button class="tablink" onclick="openPage('Dashboard', this, 'red')" id="defaultOpen">&Uuml;bersicht</button>
    <button class="tablink" onclick="openPage('Gutschriften', this, 'red')">Gutschriften</button>
    <button class="tablink" onclick="openPage('Schulden', this, 'green')">Schulden</button>
    <button class="tablink" onclick="openPage('Einnahmen', this, 'blue')">Einnahmen</button>
    <button class="tablink" onclick="openPage('Ausgaben', this, 'orange')">Ausgaben</button>
@endsection
@section('tab-contents')
    <div id="Dashboard" class="tabcontent">
        <h3>&Uuml;bersicht</h3>
        <p>Home is where the heart is..</p>
    </div>
    <div id="Gutschriften" class="tabcontent">
        <h3>Gutschriften</h3>
        <p>Home is where the heart is..</p>
    </div>

    <div id="Schulden" class="tabcontent">
        <h3>Schulden</h3>
        <p>Some news this fine day!</p>
    </div>

    <div id="Einnahmen" class="tabcontent">
        <h3>Einnahmen</h3>
        <p>Get in touch, or swing by for a cup of coffee.</p>
    </div>

    <div id="Ausgaben" class="tabcontent">
        <h3>Ausgaben</h3>
        <p>Who we are and what we do.</p>
    </div>
@endsection
