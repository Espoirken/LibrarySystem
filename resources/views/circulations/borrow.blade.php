@extends('layouts.app')
@include('inc.header')
@section('content')
@include('inc.messages')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.borrow') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-2"><h2 class="card-title">Borrow Book</h2></div>
                    <div class="col-lg-3 offset-lg-6 form-group"> 
                        <select class="form-control" id="users" name="users">
                            <option hidden></option>
                            @foreach ($users as $user)
                            @if ($user->book_counter < 3)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                            @endforeach
                        </select>   
                    </div>
                    <div class="col-lg-1"><button class="btn btn-sm btn-success float-right" type="submit"><i class="fa fa-plus"></i> Borrow</button></div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ACCESSION</th>
                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>AUTHOR</th>
                            <th>PUBLISHER</th>
                            <th>SOURCE</th>
                            <th>COPYRIGHT</th>
                            <th>DATE ADDED</th>
                            <th>STATUS</th>
                            <th>ADD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($books) > 0)
                        @foreach ($books as $book)
                        @if ($book->status == 'Available')
                            
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->book_title}}</td>
                            <td>{{$book->category->category_name}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->publisher_name}}</td>
                            <td>{{$book->source}}</td>
                            <td>{{$book->copyright_year}}</td>
                            <td>{{$book->created_at->timezone('Asia/Singapore')->format('M. d, Y - D  h:i:s A')}}</td>
                            <td>{{$book->status}}</td>
                            
                            <td>
                                <div class="form-check" id="checkbox-container">
                                    <input class="form-check-input" type="checkbox" id="{{$book->id}}" name="books[]" value="{{$book->id}}">
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center">No books found</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<script>
        jQuery(function(){
            var max = 3;
            var checkboxes = $('input[type="checkbox"]');
                                
            checkboxes.change(function(){
                var current = checkboxes.filter(':checked').length;
                checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
            });
        });
        </script>
@endsection