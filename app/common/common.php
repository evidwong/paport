<?php 
function respond($status, $respond)
{
    return response()->json(['code' => $status, is_string($respond) ? 'message' : 'data' => $respond]);
}

function succeed($respond = 'Request success!')
{
    return respond(0, $respond);
}

function failed($respond = 'Request failed!')
{
    return respond(-1, $respond);
}
 ?>