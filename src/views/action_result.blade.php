<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh
 * Date: 11/21/16
 * Time: 5:43 PM
 */
?>

@if(isset($action_result))
    @if($action_result['status'])
        <div class="success">success!</div>
    @else
        <div class="alert alert-danger">
            <ul>
        @foreach($action_result['messages'] as $msg)
            <li>{{$msg}}</li>
        @endforeach
            </ul>
        </div>
    @endif
@endif


