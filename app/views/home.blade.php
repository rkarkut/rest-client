@extends('layouts.main')

@section('content')
    
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                    <div class="col-md-8">
                        <h4>Bundles</h4>
                    </div>
                    <div class="col-md-4 add_bundle_request">

                        <a href="#" data-toggle="modal" data-target="#add_bundle" title="add new bundle"><span class="glyphicon glyphicon-folder-open"></span></a>
                    
                        <a href="#" data-toggle="modal" data-target="#add_request" title="add new request"><span class="glyphicon glyphicon-chevron-down"></span></a>
                    </div>
                </div>
            <div class="list-group bundle_list">
            
                @foreach($bundles as $bundle)
                
                    <div class="list-group-item active">
                        <a href="#" class="">{{ $bundle->name }}</a>
                        <a class="edit edit-bundle" data-toggle="modal" data-target="#edit_bundle_{{ $bundle->id }}" href=""><span class="glyphicon glyphicon-edit"></span></a>
                    </div>

                    <div class="list-group-subitems">
                                 
                    @foreach($bundle->requests as $request)
                        <div>
                            <a href="#" data-id="{{ $request->id }}" class="load-request">{{ $request->name }}</a>        
                            <a class="edit edit-request" data-toggle="modal" data-target="#edit_request_{{ $request->id }}" href=""><span class="glyphicon glyphicon-edit"></span></a>
                        </div>
                    @endforeach
                    </div>
                @endforeach

            </div>

        </div>
        <div id="request_content" class="col-md-9">
            
            <h3>Authorize</h3>

            <div class="form-group">

                <div class="row">
                    
                    <div class="col-md-9">
                        
                        <label for="request_url">URL:</label>
                        <input class="form-control" id="request_url" type="text" value="http://vemma.v.l/mobileapi/authorize/?ver=3_0">

                    </div>
                    <div class="col-md-3 request_method">
                        <label for="request_method">Method:</label>
                        <select name="" id="request_method" class="form-control">
                    
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>

                        </select>

                    </div>
                </div>

            </div>

            <div class="form-group">
                <label for="request_text">Request:</label>
                <textarea class="form-control" id="request_text" rows="3">{"jsonrpc":"2.0","id":1,"method":"authorize","params":["100000201","TestApp677"]}</textarea>
            </div>

            <div class="form-group">

                <button type="button" class="btn btn-primary send-request">Send</button>
            </div>

            <div class="response">
                <label for="request_input">Response:</label><br>
                <section>
                <div id="request_response"></div>
                </section>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_bundle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="row">
            
            <div class="col-md-1"></div>
            <div class="col-md-10">
                
                <form action="">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Add new bundle</h4>
                          </div>
                          <div class="modal-body">
                                <div class="alert alert-danger" style="display:none"></div>
                                <div class="alert alert-success" style="display:none"></div>
                                <div class="row">
                                    <label for="add_bundle_input">Name:</label>
                                    <input type="text" id="add_bundle_input" class="form-control" placeholder="Name" />
                                </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary button_add_bundle">Add bundle</button>
                          </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>

    </div>

    @foreach($bundles as $bundle)

        <div class="modal fade" id="edit_bundle_{{ $bundle->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="row">
                
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    
                    <form action="">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Edit bundle</h4>
                                </div>

                                <div class="modal-body">

                                    <div class="alert alert-danger" style="display:none"></div>
                                    <div class="alert alert-success" style="display:none"></div>

                                    <div class="row">

                                        <label for="edit_bundle_input">Bundle name:</label>
                                        <input type="text" id="edit_bundle_input_{{$bundle->id}}" class="form-control" placeholder="Name" value="{{$bundle->name}}" />
                                    </div>
   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" data-input="edit_bundle_input_{{$bundle->id}}" data-id="{{$bundle->id}}" class="btn btn-primary button_update_bundle">Update bundle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>

        @foreach($bundle->requests as $request)

        <div class="modal fade" id="edit_request_{{$request->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="row">
                
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    
                    <form action="">
                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Update request</h4>
                                </div>
                                
                                <div class="modal-body">

                                    <div class="alert alert-danger" style="display:none"></div>
                                    <div class="alert alert-success" style="display:none"></div>

                                    <div class="row">
                                        <label for="update_request_name">Name:</label>
                                        <input type="text" id="update_request_name" class="form-control" placeholder="Name" value="{{$request->name}}" />
                                    </div>

                                    <div class="row">
                                        <label for="update_request_method">Method:</label>
                                        <select id="update_request_method" name="" class="form-control">
                                            <option @if ($request->method == "GET") selected="selected" @endif value="GET">GET</option>
                                            <option @if ($request->method == "POST") selected="selected" @endif value="POST">POST</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <label for="update_request_url">URL:</label>
                                        <input type="text" id="update_request_url" class="form-control" placeholder="URL" value="{{$request->url}}" />
                                    </div>

                                    <div class="row">
                                        <label for="update_request_content_type">Content Type:</label>
                                        <select id="update_request_content_type" name="" class="form-control">
                                            <option @if ($request->content_type == "application/json") selected="selected" @endif value="application/json">application/json</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <label for="update_request_content">Content:</label>
                                        <textarea class="form-control" name="update_request_content" id="update_request_content">{{$request->content}}</textarea>
                                    </div>

                                    <div class="row">
                                        <label for="update_request_bundle">Bundle:</label>
                                        <select id="update_request_bundle" name="" class="form-control">
                                        @foreach( $bundles as $bundle )
                                            <option @if ($request->bundle_id == $bundle->id) selected="selected" @endif value="{{ $bundle->id }}">{{ $bundle->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" data-id="{{$request->id}}" class="btn btn-primary button_update_request">Update request</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        @endforeach

    @endforeach

    <div class="modal fade" id="add_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                
                <form action="">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Add new request</h4>
                          </div>
                          <div class="modal-body">
                                <div class="alert alert-danger" style="display:none"></div>
                                <div class="alert alert-success" style="display:none"></div>

                                <div class="row">
                                    <label for="add_request_name">Name:</label>
                                    <input type="text" id="add_request_name" class="form-control" placeholder="Name" />
                                </div>

                                <div class="row">
                                    <label for="add_request_method">Method:</label>
                                    <select id="add_request_method" name="" class="form-control">
                                        <option value="GET">GET</option>
                                        <option value="POST">POST</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <label for="add_request_url">URL:</label>
                                    <input type="text" id="add_request_url" class="form-control" placeholder="Name" />
                                </div>

                                <div class="row">
                                    <label for="add_request_content_type">Content Type:</label>

                                    <select name="content_type" id="add_request_content_type" class="form-control">
                                        <option value="application/json">application/json</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <label for="add_request_content">Content:</label>
                                    <textarea class="form-control" name="add_request_content" id="add_request_content"></textarea>
                                </div>

                                <div class="row">
                                    <label for="add_request_bundle">Bundle:</label>

                                    <select name="" id="add_request_bundle" class="form-control">
                                    @foreach( $bundles as $bundle )
                                        <option value="{{ $bundle->id }}">{{ $bundle->name }}</option>
                                    @endforeach
                                    </select>
                                </div>

                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary button_add_request">Add request</button>
                          </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

@stop
