@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">URL's</div>
                <div class="card-body">
                        <table class="table table-hover table-striped table-bordered table-text-sm mb-2 unify ">
                            <thead>
                            <tr class="text-center">
                                <th>URL Completa</th>
                                <th>Short</th>
                                <th>Data de Expiração</th>
                            <tr>
                            </thead>
                            <tbody>
                            @foreach($urls as $url)
                                <tr id="row{{ $url->id }}">
                                    <td class="text-left text-md-center">
                                        {{ $url->url_complete }}
                                    </td>
                                    <td class="text-left text-md-center">
                                        {{ $url->shortened }}
                                    </td>
                                    <td class="text-left text-md-center">
                                        {{ \Carbon\Carbon::parse($url->expiration_date)->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2 overflow-auto">
                            {{ $urls->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
