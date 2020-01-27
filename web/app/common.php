<?php

    use think\Db;
    use cmf\lib\Storage;

    /* curl get请求 */
    function curl_get($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查  
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
		$return_str = curl_exec($curl);
		curl_close($curl);
		return $return_str;
	} 
    /* curl POST 请求 */
	function curl_post($url,$curlPost=''){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_POST, true);
        if($curlPost){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        }
        
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查  
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
		
		$return_str = curl_exec($curl);
		curl_close($curl);
		return $return_str;
	}
    /* curl 文件上传 
        param 格式
        $param=[
            'id'=>$id,
            'file'=>$_FILES['file'],
        ];
    */
    function curlFile($url,$param) {
        
        $delimiter=uniqid();
        
        $post_data = '';
        $eol = "\r\n";
        $upload = $param['file'];
        unset($param['file']);

        foreach ($param as $name => $content) {
            $post_data .= "--" . $delimiter . "\r\n"
                . 'Content-Disposition: form-data; name="' . $name . "\"\r\n\r\n"
                . $content . "\r\n";
        }
        // 拼接文件流
        $post_data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name="file"; filename="' . $upload['name'] . '"' . "\r\n"
            . 'Content-Type:'.$upload['type']."\r\n\r\n";

        $post_data .= file_get_contents($upload['tmp_name']) . "\r\n";
        $post_data .= "--" . $delimiter . "--\r\n";
        
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: multipart/form-data; boundary=" . $delimiter,
            "Content-Length: " . strlen($post_data)
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $info = json_decode($response, true);
        return $response;
    }