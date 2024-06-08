<?php


function drawFilters()
{

        $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $urlComponents = parse_url($currentUrl);
        $params = [];
        if (isset($urlComponents['query'])) {
            parse_str($urlComponents['query'], $params1);
            $params = $params1;
        }




    $result = '
    <h2 class="fs-4 mt-2">Filtering</h2>
    <form id="orderForm" class="form-floating" action="' . $urlComponents['path'] . '" method="get" onchange="document.getElementById(\'orderForm\').submit()">
      <select class="form-select" name="orderBy" id="orderBy" aria-label="Select Order By">
        <option value="1" '. (isset($params["orderBy"]) && $params["orderBy"] == 1 ? "selected" : "" ) .' >&#8593;Book title</option>
        <option value="2" '. (isset($params["orderBy"]) && $params["orderBy"] == 2 ? "selected" : "" ) .'>&#8595;Book title</option>
        <option value="3" '. (isset($params["orderBy"]) && $params["orderBy"] == 3 ? "selected" : "" ) .'>&#8593;Price</option>
        <option value="4" '. (isset($params["orderBy"]) && $params["orderBy"] == 4 ? "selected" : "" ) .'>&#8595;Price</option>
        <option value="5" '. (isset($params["orderBy"]) && $params["orderBy"] == 5 ? "selected" : "" ) .'>&#8593;Author</option>
        <option value="6" '. (isset($params["orderBy"]) && $params["orderBy"] == 6 ? "selected" : "" ) .'>&#8595;Author</option>
      </select>';

    foreach ($params as $key => $value) {
        if ($key == "orderBy") {
            continue;
        }
        $result .= "<input type='text' name='". htmlspecialchars($key) ."' style='display: none;' value='" . htmlspecialchars($value)."'>";
    }


    $result.= '<label for="orderBy">Order by</label>
    </form>';

    echo $result;
}

?>