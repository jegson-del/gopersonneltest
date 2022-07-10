<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Go 2 PersonalTest</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>

<div>
    <div class="container min-h-screen py-4 sm:pt-0 items-top ">
        <nav class="navbar navbar-light bg-light w-100">
            <div class="container-fluid justify-content-between">

                <a class="navbar-brand" href="#">Contact List</a>

                <!-- Button trigger modal -->
                <a href="#" class=" btn btn-primary px-2 py-2 btn-sm" type="button" data-toggle="modal"
                   data-target="#contactModal">Add Contact
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                         class="bi bi-plus font-bold" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </a>
                <!-- End Button trigger modal -->
            </div>
        </nav>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel"> Add Contacts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('contacts.store')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">First Name</label>
                            <input id="first_name" name="first_name" placeholder="first_name" type="text"
                                   class=" form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Last Name</label>
                            <input id="last_name" name="last_name" placeholder="last_name" type="text"
                                   class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input id="email" name="email" placeholder="email" type="text" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Telephone</label>
                            <input id="telephone" name="telephone" placeholder="telephone" type="text"
                                   class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
    <div class="container color-grey-lighter ">
        <div class=" ">
            <input class="form-outline" id="search" type="text" placeholder="Search..">
        </div>
        <table class="table table table-striped container-sm bg-light table-bordered " id="contacts">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Telephone</th>
            </tr>
            </thead>
            <tbody class="allData">

            <tbody id="tbody" class="searchData">

            </tbody>

            </tbody>
        </table>
    </div>
</div>

<div>


</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>


</div>
</body>

<script>
    $(document).ready(function () {

        fetchcontact()

        function fetchcontact() {
            $.ajax({
                type: "GET",
                url: "fetch-contacts",
                dataType: "json",
                success: function (contacts) {
                    var data = contacts['contacts'];
                    $('#pagination').html(contacts);
                    //looping through contacts
                    $.each(data.data, function (key, data) {
                        $('#tbody').append("<tr>",
                            ' <th>' + data.id + '</th>',
                            '<td>' + data.first_name + '</td>',
                            '<td>' + data.last_name + '</td>',
                            '<td>' + data.email + '</td>',
                            '<td>' + data.telephone + '</td>',
                            " </tr>");
                        $('#pagination').html(data.data);
                    });

                }
            })
        }

        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();

            //Conditional Rendering
            if (value) {
                $('.allData').hide();
                $('.searchData').show();
            } else {
                $('.allData').show();
                $('.searchData').hide();
            }

            $.ajax({
                type: 'get',
                url: '{{\Illuminate\Support\Facades\URL::to('search')}}',
                data: {'search': value},

                success: function (data) {
                    console.log(data);
                    $('.searchData').html(data);
                }
            });
        });

    });
</script>

</html>
