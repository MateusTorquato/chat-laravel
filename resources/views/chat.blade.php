@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <h3>Mensagens</h3>
                            <hr>
                            <div class="container chats">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-default">
                                            <div id="card-mensagens" class="card-body" style="max-height: 350px; overflow-y: auto;">
                                            </div>
                                            <div class="card-footer input-group">
                                                <input id="input-msg" type="text" name="mensagem" placeholder="Escreva sua mensagem aqui..." class="form-control input-sm">
                                                &nbsp
                                                <button id="btn-enviar-chat" class="btn btn-primary btn-sm">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h3>Participantes</h3>
                            <hr>
                            <ul id="list-participantes">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/chat.js?v=1')}}"></script>
@endsection
