<?php

class Home extends Controller{
    public function index($params_str = "") {
        $params = $this->explodeParams($params_str);
        if (isset($params['page'])) {
            $submodel = $this -> model($params['page']);
            if (isset($params['action'])) {
                $action = $params['action'];
            } else {
                $action = 'show';
            }
            $subdata = array(
                'model' => $params['page'],
                $params['page'] => $submodel -> $action($params)
            );
        }
        $model = $this -> model("main");
        $data = array(
            "main" => $model -> show($params),
            "params" => $params
        );
        if (isset($subdata)) {
            $data['subdata'] = $subdata;
            $data[$data["subdata"]['model']] = $data["subdata"][$data["subdata"]['model']];
        }
        $this -> view("main", $data);
    }
}

?>