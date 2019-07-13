@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Ajouter des livres</h1>
                <form action="/books/store" method="POST">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="title">Titre du livre</label>
                                <input id="title" class="form-control" type="text" name="title">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="slug">Slug du livre</label>
                                <input id="slug" class="form-control" type="text" name="slug">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="author">Auteur du livre</label>
                                <input id="author" class="form-control" type="text" name="author">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="summary">Résumé du livre</label>
                                <textarea class="form-control" name="summary" id="summary" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Sauvegarder</button>
                </form>
            </div>

        </div>
    </div>
@endsection