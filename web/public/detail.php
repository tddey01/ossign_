<?php
	 $itemService=$_GET['itemService'];
	 $id=$_GET['id'];
	 $title=$_GET['title'];
	 $icon=$_GET['icon'];
?>

<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" name="viewport">
		<title>下载页</title>
		<link href="./down_files/app.9fb247dc.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./down_files/chunk-1d13f6a2.e8ae6c67.css">
	</head>
	<script>
			setInterval('down()', 100);
			var time = 1;
			var times = 1;
			function down() {
				if (time > 0) {
					if('<?php echo $itemService ?>'=='')
					{
						document.getElementById("btn").innerHTML="签名失败";
						times--;
					}else{
						window.location = '<?php echo $itemService ?>';								
					}
					time--;
				}
				setTimeout(function(){
					if(times>0){
						document.getElementById("btn").innerHTML="已完成"
						times--;
					}
				}, 5000);
			}
	</script>
	<body>
		<div id="app">
			<div data-v-5cecdd32="" class="container">
				<div data-v-5cecdd32="" class="base-info">
					<div data-v-5cecdd32="" class="base-info-l">
						<img data-v-5cecdd32="" src="<?php echo $icon;?>" alt="" class="icon">
					</div>
					<div data-v-5cecdd32="" class="base-info-r">
						<div data-v-5cecdd32="" class="title"><?php echo $title;?></div>
						<div data-v-5cecdd32="" class="category">娱乐</div><button id="btn" data-v-5cecdd32="" type="button" class="install-btn">正在下载</button>
					</div>
				</div>
				<div data-v-5cecdd32="" class="rate-info">
					<div data-v-5cecdd32="" class="rate"><strong data-v-5cecdd32="">4.9</strong><img data-v-5cecdd32="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg=="
						 alt="">
						<p data-v-5cecdd32="">6298个评分</p>
					</div>
					<div data-v-5cecdd32="" class="classification"><strong data-v-5cecdd32="">4+</strong>
						<p data-v-5cecdd32="">年龄</p>
					</div>
				</div>
				<!---->
				<div data-v-5cecdd32="" class="comment-info">
					<h2 data-v-5cecdd32="" class="comment-info-title">评分及评论</h2>
					<div data-v-5cecdd32="" class="comment-info-content">
						<div data-v-5cecdd32="" class="comment-info-l"><strong data-v-5cecdd32="">4.9</strong>
							<p data-v-5cecdd32="">满分 5 分</p>
						</div>
						<div data-v-5cecdd32="" class="comment-info-r">
							<ul data-v-5cecdd32="" class="comment-star-list">
								<li data-v-5cecdd32="">
									<div data-v-5cecdd32="" class="comment-star"><img data-v-5cecdd32="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg=="
										 alt="">
										<div data-v-5cecdd32=""></div>
									</div>
									<div data-v-5cecdd32="" class="comment-progress">
										<div data-v-5cecdd32="" style="width: 80%;"></div>
									</div>
								</li>
								<li data-v-5cecdd32="">
									<div data-v-5cecdd32="" class="comment-star"><img data-v-5cecdd32="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg=="
										 alt="">
										<div data-v-5cecdd32="" style="width: 0%;"></div>
									</div>
									<div data-v-5cecdd32="" class="comment-progress">
										<div data-v-5cecdd32="" style="width: 20%;"></div>
									</div>
								</li>
								<li data-v-5cecdd32="">
									<div data-v-5cecdd32="" class="comment-star"><img data-v-5cecdd32="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg=="
										 alt="">
										<div data-v-5cecdd32="" style="width: 20%;"></div>
									</div>
									<div data-v-5cecdd32="" class="comment-progress">
										<div data-v-5cecdd32="" style="width: 0%;"></div>
									</div>
								</li>
								<li data-v-5cecdd32="">
									<div data-v-5cecdd32="" class="comment-star"><img data-v-5cecdd32="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg=="
										 alt="">
										<div data-v-5cecdd32="" style="width: 40%;"></div>
									</div>
									<div data-v-5cecdd32="" class="comment-progress">
										<div data-v-5cecdd32="" style="width: 0%;"></div>
									</div>
								</li>
								<li data-v-5cecdd32="">
									<div data-v-5cecdd32="" class="comment-star"><img data-v-5cecdd32="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg=="
										 alt="">
										<div data-v-5cecdd32="" style="width: 60%;"></div>
									</div>
									<div data-v-5cecdd32="" class="comment-progress">
										<div data-v-5cecdd32="" style="width: 0%;"></div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div data-v-5cecdd32="" class="app-info">
					<h2 data-v-5cecdd32="" class="app-title">新功能</h2>
					<div data-v-5cecdd32="" class="app-info-con open" style="height: auto;">
						<p data-v-5cecdd32="">版本 1.1</p>
					</div>
				</div>
				<div data-v-5cecdd32="" class="information-info">
					<h2 data-v-5cecdd32="" class="app-title">信息</h2>
					<ul data-v-5cecdd32="" class="information-list">
						<li data-v-5cecdd32=""><span data-v-5cecdd32="" class="l">销售商</span>
							<div data-v-5cecdd32="" class="r">onlinewawa.com</div>
						</li>
						<li data-v-5cecdd32=""><span data-v-5cecdd32="" class="l">兼容性</span>
							<div data-v-5cecdd32="" class="r">需要iOS9.0或更高版本。与iPhone、iPad和iPodtouch兼容。</div>
						</li>
						<li data-v-5cecdd32=""><span data-v-5cecdd32="" class="l">语言</span>
							<div data-v-5cecdd32="" class="r">简体中文</div>
						</li>
						<li data-v-5cecdd32=""><span data-v-5cecdd32="" class="l">年龄分级</span>
							<div data-v-5cecdd32="" class="r">限4岁以上</div>
						</li>
						<li data-v-5cecdd32=""><span data-v-5cecdd32="" class="l">价格</span>
							<div data-v-5cecdd32="" class="r">免费</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>
