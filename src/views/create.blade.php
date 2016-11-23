<html>
    <head>
        <title>Nested category</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                            font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .alert-danger{
                color: #ff0000;
            }

            .success{
                background-color: darkgreen;
                padding: 5px;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @include('NestedCategories::action_result')

                <form action="{{$route}}" method="post">
                    title: <input type="text" name="title" id="title"/><br/>
                    parent:
                    <select name="parent_id" id="parent_id">
                        <option value="0">root</option>
                        @if(isset($treeList) && sizeof($treeList))
                            @foreach($treeList as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        @endif
                    </select>
                    <br/>
                    status:
                    <select name="status" id="status">
                        <option value="1">enable</option>
                        <option value="2">disable</option>
                    </select>
                    <br/>
                    <input type="submit" value="save"/>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </body>
</html>
