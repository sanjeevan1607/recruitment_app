<?php
if (!function_exists('isInteger')) {
    /**
     * @param $var Object
     * @return \Illuminate\Http\JsonResponse
     */
    function isInteger($var)
    {

        $data = ['var' => $var];
        $validator = Validator::make(
            $data, [
            'var' => [
                'required', 'numeric'
            ]
        ])->validate()
        ;
        if ($validator->fails()) {
            return response()->json(
                [
                    'data' => null,
                    'status' => false,
                    'message' => 'Validation  Error'
                ], 400);
        }

    }
}
if (!function_exists('json_response')) {
    /**
     * @param $status
     * @param $message
     * @param null $data
     * @param $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    function json_response($status, $message, $data = null, $status_code)
    {

        return response()->json(
            ['status' => $status,
                'message' => $message,
                'data' => $data,
            ], $status_code);

    }
}
if (!function_exists('fileUploadUrl')) {
    /**
     * @param $input
     * @param $input_name
     * @param $folder
     * @param $slug
     * @return string
     */
    function fileUploadUrl($input, $inputName, $folder, $slug)
    {

        $slug = $slug ? $slug : null;
        $fileName = md5(time()) . $slug . '.' . $input[$inputName]->getClientOriginalExtension();
        $input[$inputName]->move('../storage/app/public/' . $folder, $fileName);
        return $file_path = 'storage/' . $folder . '/' . $fileName;
    }
}

if (!function_exists('settingData')) {

    function settingData($key)
    {

        $setting = App\Settings::where('key', $key)->first();



        return $setting->value;

    }
}







