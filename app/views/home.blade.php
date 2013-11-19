@extends('layouts.main')

@section('content')
    
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                    <div class="col-md-9">
                        <h4>Bundles</h4>
                    </div>
                    <div class="col-md-3"><a href="#" data-toggle="modal" data-target="#add_bundle" title="add new bundle"><span class="glyphicon glyphicon-folder-open"></span></a></div>
                </div>
            <div class="list-group">
            
                @foreach($bundles as $bundle)
                
                <a href="#" class="list-group-item active">{{ $bundle->name }}</a>

                <div class="list-group-subitems">
                             
                    <a href="#" class="">Authorize</a>        
                                        
                </div>
                @endforeach

            </div>

        </div>
        <div class="col-md-9">
            
            <h3>Authorize</h3>

            <div class="form-group">

                <div class="row">
                    
                    <div class="col-md-9">
                        
                        <label for="url_input">URL:</label>
                        <input class="form-control" id="url_input" type="text" value="http://vemma.v.l/mobileapi/authorize/?ver=3_0">

                    </div>
                    <div class="col-md-3">
                        <label for="url_input">Method:</label>
                        <select name="" id="" class="form-control">
                    
                            <option value="">GET</option>
                            <option value="">POST</option>

                        </select>

                    </div>
                </div>

            </div>

            <div class="form-group">
                <label for="request_input">Request:</label>
                <textarea class="form-control" rows="3">{"jsonrpc":"2.0","id":1,"method":"authorize","params":["100000201","TestApp677"]}</textarea>
            </div>

            <div class="form-group">

                <button type="button" class="btn btn-primary">Send</button>
                <button type="button" class="btn btn-default">Save</button>
            </div>

            <div class="response">
                <label for="request_input">Response:</label><br>
                <section>
                <code>
                    {
                        "jsonrpc": "2.0",
                        "id": 1,
                        "error": {
                            "code": "-32600",
                            "message": "Invalid login or password"
                        }
                    }
                </code>
                </section>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_bundle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <button type="button" onclick="Page.addBundle();" class="btn btn-primary">Add bundle</button>
                  </div>
                </div>
            </div>
          </form>
    </div>

@stop
