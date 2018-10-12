<?php
	$desc = [
		"Your vote was recorded during the elections. We are now waiting for validation that you deposited your card in the ballot box. Your vote can be seen in the diagram above.",
		"Your card has been detected by the ballot box. This means that your vote is now official and will be used in the result. Congratulations! You contributed towards a safer and more transparent democracy.",
		"",
		"All of the valid votes have been counted and there is now an official result. The amount of votes your favored party got, is being shown underneath this information paragraph. To see more of the results, visit your official government website.",
		"Your vote has not been registered yet. It could be the case that there was a mistake with the voting process, but it is most likely that you inserted a wrong vote ID. Please check check triplecheck your vote ID."
	];

	$parties = [
		"dog" => "#e67e22",
		"elephant" => "#9b59b6",
		"dolphin" => "#f1c40f",
		"lion" => "#e74c3c",
		"unknown" => "#A2A2A2"
	];

	//  Initiate curl
	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL, "http://10.42.0.65/vote.php?id=" . urlencode($_GET["id"]));
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);

	// Will dump a beauty json :3
	$json = json_decode($result, true);

	if (is_null($json)) {
		$json = [
			"status" => 4,
			"vote_party" => "unknown"
		];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Find my vote</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script>
			document.addEventListener("DOMContentLoaded", function(event) {
				document.getElementById("searchButton").addEventListener("click", function(event) {
					var vl = document.getElementById('searchInput').value

					if (vl.length == 8) {
						window.location.href = '/' + vl
						event.preventDefault()
					}
				})
			})
		</script>

		<link rel="shortcut icon" type="image/png" href="https://i.imgur.com/gESF7Vo.png">
		<link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<!-- <link rel="stylesheet" href="./assets/css/main.css"> -->
		<style media="screen">
		body {
			margin: 0;
			font-family: Roboto, sans-serif;
		}

		header {
			background: #2980b9 !important;
		}

		#vote {
			height: 40vh;
			background: #e67e22;
			display: flex;
			flex-direction: column;
			padding-top: 64px;
		}

		#vote > svg {
			fill: #fff;
			padding-top: 5vh;
		}

		#vote > span {
			color: #fff;
			text-align: center;
			padding-top: 2vh;
			padding-bottom: 5vh;
			font-size: 4vh;
		}

		#status {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			min-height: 80vh;
			box-sizing: border-box;
		}

		#status.unknown {
			filter: grayscale(1);

		}

		#status > div:first-child {
			display: flex;
			max-width: 1400px;
			width: 100vw;
		}

		#status > div:first-child > div {
			display: flex;
			flex-direction: column;
			color: #333;
			position: relative;
			flex-grow: 1;
		}

		#status > div:first-child > div::before {
			content: "";
			position: absolute;
			border-top: 20px dotted #2980b9;
			width: 50%;
			left: -50%;
			top: 40%;
			transform: translateY(-50%) translateX(50%);
		}

		#status > div:first-child > div.waiting::before {
			border-top: 20px dotted #eee;
		}

		#status > div:first-child > div:first-child::before {
			display: none;
		}

		#status > div:first-child > div > svg {
			padding: 0 25%;
			flex-grow: 1;
		}

		#status > div:first-child > div > span {
			text-align: center;
			padding-top: 20px;
			font-size: 20px;
		}

		#status > div:first-child > div.waiting > svg {
			filter: grayscale(1);
		}

		#status > div:first-child > div.waiting > span {
			opacity: .5;
		}

		#status > div:last-child {
			padding: 15vh 5vw 0 5vw;
		}

		#status > div:last-child > p {
			font-size: 22px;
			text-align: justify;
			max-width: 1000px;
			margin: auto;
		}

		#search {
			padding-top: 20vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		#search > input {
			padding: 2vh 4vh;
			font-size: 3vh;
		}

		#logo {
			margin: auto;
			display: block;
			width: 50vw;
			max-width: 500px;
			margin-top: 20vh;
		}

		#error {
			height: 20vh;
			font-size: 22px;
			padding-top: 20vh;
			display: block;
			text-align: center;
		}

		#stat {
			text-align: center;
			padding-bottom: 10vh;
			font-size: 40px;
			color: #555;
		}

		@media screen and (-webkit-min-device-pixel-ratio:0) {
			#status > div:first-child > div::before {
				width: 30%;
				left: -50%;
				top: 50%;
				transform: translateY(-50%) translateX(120%);
			}

			#status > div:first-child > div > svg {
				margin-bottom: -20%;
			}
		}

		@media only screen and (max-width: 1200px) {
			#status > div:first-child {
				flex-direction: column;
				max-width: 300px;
			}

			#status > div:first-child > div {
				padding: 20% 0;
			}

			#status > div:first-child > div::before {
				display: none;
			}

			#status > div:first-child > div::after {
				content: "⌄";
				position: absolute;
				bottom: 0;
				left: 50%;
				color: #2980b9;
				transform: translateX(-50%) translateY(50%);
				font-size: 60px;
			}

			#status > div:first-child > div.waiting::after {
				color: #eee;
			}

			#status > div:first-child > div:last-child::after {
				display: none;
			}

			#status > div:last-child > p {
				padding-bottom: 60px;
			}

			#stat {
				font-size: 23px;
			}
		}

		@media only screen and (max-width: 500px) {
			#status > div:last-child > p {
				text-align: left;
			}
		}

		</style>

		<!-- <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js" charset="utf-8"></script> -->
		<!-- <script src="./assets/js/main.js" charset="utf-8"></script> -->
	</head>
	<body>
		<header class="mdc-top-app-bar">
			<div class="mdc-top-app-bar__row">
			<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
				<a href="." style="color: #fff" class="mdc-top-app-bar__title">Find My Vote</a>
			</section>
			</div>
		</header>

		<main class="main-content" id="main-content">
			<?php if (is_null($_GET["id"])): ?>
				<form id="search" action="." method="get">
					<input type="text" id="searchInput" placeholder="Enter vote ID" name="id" id="id"><br>
					<input type="submit" id="searchButton" value="Search!">
				</form>
				<img id="logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA5cAAAHyCAMAAABI7coXAAAC7lBMVEUAAAAmgLkpgLkogLkAAAAAAAArgLgAAAAAAAD17O0AAAAAAAAAAADi08IAAABSmcQAAAAAAAApgLkAAAAAAAAAAAApgLkAAAAAAAApgLn15+cpgLmzn60pgLkogbnypKQpgLn89fYpgLnr29z02tgpgLnt1dEpgLnOtrz2wrv4zcoogLr2uafYxMUogLkpgLnoztDXtbrAqrQpgLopgLl+uNAAAABpWIRjkaH////76d/+/f59ttBqWIN+ts59uM59t8x/t897t9BpWIV9uNL9//38/f1LeoR+utJ8uM5oWYJkkJ9Ne4Z8tc1hkJ352Mhkk6JJdoOAttF7t9NmWIZjWYX//fv86+D20L6RW33//f/9/vr6+/t4utP8//94vNdrVoX///18s8d5tcx/uNHs9Pdkl6j4/Px1tM746t94s8zyx7SEuc5wpLj96eCbrcR5tdB1wt5WhpLzw1X86eL86dz618b++fd1vdV1sMuLvM9MfIrm8vdyssrzwlh7udC92uT6zsv32MVjVYi21OCOs8eCtsuaxNV5uc30+vu41uP57OLr6+p3s8jY6fCqo7GCu9Wiydr1xlT87OX19fXv9/n68+bP4+v30sHyzrj77+h2vtrG3ecaTVr72cn53c5dlKTxwlCYrMCxsrKGu9D0yLb89O64uLnx8fHZ2dn4zbyTwNLHyMjS5u52dnZfU4eqzduFvtj75dni8PWAa39wcHDf39+IiIgWSVTd7fKbWXY3ZXSv0t9ubW37ylJzqr/64dRmkKG/v8D43sNqWX5lZWXzsKDyy4TyzVSoqqocTlympqX4yMMgUl7Q0NCAgIFxkZ4aTFmogYju7u374N31wq9hYWL0t6r2vbeYl5iIipbl5OTznpqiqbr0slp7e3qsrKxdXl5YV1eSeHrgwVx5XINleH/Kr2a2m2/ylZDuX1qPjo30wE6ijHTqZ2IZSlpPi77FUExLSUnYoqQ/bn71aWKAQT+oa3ZgNzWcPjzoPBK8AAAANHRSTlMAKIROI9sjWME5sJsOi/QP64iuc0s99WYsxEnn/tU69mcbdmBwjH9YxrualNWkppyP/uGhtaj4xQAAWVZJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAZtf+QdqI4gCOnwYKHYrQQUglYq2t9K+UCgcPbnrbW1zeEbvdGoTrkFyhS6De6GZAYgbFIR26BEKmDkXaw2Zwa0M6uWiIQ4VuXfv7nZe/JmqTkHp3v09ITkyQPMyX90cJIYQQQgghxHP7gRIK9xVCfOPT69rrcPijEOITj2qFgq5LoMPlH/EGebPZMLaCfK0Q4hN3agVbbyODQW9jI70gPimE+MRCzbaFELpwH4JIl5xjqA51SXzjds3WVd6iagEhGjfhaIZhSF2jLsnN9uzo6BnckVKybW608GAwWoTjYJe0jiU33FGyvJlMp5Plcjm9AF0aQPWIYNCaIEucMGl/SW66ozJIp9N4eV4q2IYInI4FLWQppc2pS3KjQZdplNz8nL4DXWqiSQsc1QB47tOny4nl8VPaDPumJpXR/TRPVBlcZPmabo34faNpNDMzE4tFo9G7L5aeTs7PLUZmJ6YUP3h0lEy6Wf6CLh+VClJTW4yA6BgRhyx1jbq8rohPu+xvOha9+3R+cfaWMnIL1Z+Hh4fvh5OF+9q3vb3GfJmELm1DDTJuqEJoKnV5fbHAddkyE12aj0woI/LkZ3a3yFg8k8nE+9vo+qrbBshtfP2WxDCT2OUmrmPVQOPc3WLatI69vsXgdtmYP5fmZode3h4c7v7IfPiwNbxc7kOOuqQurzAT9C5d09GHkSHaXPi5n8kBmCmZJ57Y6CnRvPWUSLBUJvX12x51SV1eai4MXbqi8xMDVrnDct+hStNi50zmsi7cOlg9X2BClzRfUpdXmZkKS5cgNtkzzXuPD/qq5neKmRxMdAlmWQzBNtFkKHHh1iHR+wWpDKMuqcsrTYaoSxCdm1I63H5creTRx+2LVtf3ra1chmGTFty9MBlUOiDsktax1OWVpqdC1SUM+NVs21R5UMl/dIuExy6r2fXdYnxra4NZwDRN1sbs44rnWWN/maQuqctLPQxZlyAaUVxPoEovwnwH7HQ1m13ZNzNwWGOBomWmYCWKLumOtVCX1OVQQ5y+FbouYae5CFNlFatca8nnzy8Aq3y7s1s04RA1xdx1LMIqPX2zvPwFdB77/3/5/uhyeSmEXS6/8abKtW7uZIlVvl3xskxtJFgKkrRYm5HuLw389Equ4j+Tdn2g4UHAt/2MuhxwiBNh6/L3QXXNrTLfq0ngVrlfZHG3pMb56oi6NC92aWiqlJJrGnzlVuheuaE5XErH52FSlwMO8W64uoSpcm171Z0p27t0V68gC7wssUuLjVLv/aVhqEJAl6qqao7gUtelVB3HEUKDXOHKVR+jLgcd4myIuvxyUIFDne3uLPNwIAubSrT+FsAi1orHGRhHl5JDhRrnkgth23YB6QKClJxr2KWfw6QuBx1iNDRdvqyuNdev+Xx7lavNuRLgdAlZJhLj6lJ1gKZyCVXWSqDGbVsKISFLzJO6DGOXy5FQdPkOF7BelJhlV5TIq9LLEoypS+EAIYRd0I7PTuv1+ulZyYYpU+ATXFKXo+SfLmMh6PLL+Qks5FjpOOlpVemuYXd2VlZwEWvF2di65NClZmiqEHrprH5ykkzundRPjx0BHHiGuhwp/3S5vBj0LlsL2Eql0owS95RN2fV1zHIHZ0vI0u1yPOc+eLZjGBzyhCzL5c+gXD6pHzu4lsVnhFD9i7ocfIixYHdZxSrdLLFLb6Jsa3IbqoQsV1aaWZqYUCrOwDi6dOuTtoFZbqaRG6Zt2wL/duJQlyPkoy7/sncHr21bcRzA1QUCPRl2KKQhaZIl69Ju3coEBoFPvvmii4O8W64ioB4iGXYZRGYn3SIwsg4WHbgduhRMTzsMsRYvBx9rnEPXS1vaQwf9E/b7PSmW5VjRi+N5e+r7bnFGksVL109/7z3/fpK4kV+Xj8NtZWJL2RlHSVTirlKO95YoCKIZxkLWsagPznyeRiwxxydv3uO9S8rc5ZzDksvVQk5d3keVyRPYjp8slbVoX1nHRCwhyHIx9bKILMvVJ6W/34QXloU3+OTJu9dVOPvhLsVP16W4lUuXYQ9si5CMgr2vCZVwCIsqx1iS4x6NsFyYyyq4fPv+zcnhKA9P3vz9vEFcMt3ww11e5Ue8Ucify8c4xNWJOE5jiS6jM1jTRJV4EqspEomWynL+/T54RfLGk6eRS6yYDw8fHsNCtoouixXuco5hyqX4We5c/jho1fy4Tp6xTAQ2lnLI0oyqpQYu/70oqS5L4y7xs8foEloK9ll+kYS7vOqPeGM5by57fm2yM701ubGsx8XSTGG5CJdF6MQjLn8/RpOHo4OfBros8z68eYYtl+LdnLl8PPBbSZXJRSzZWGK1rEPgwUxhuQCXeL/nUvXJczz3IS4Pict3sL+sgknucq5hzKW4nC+XvU782kjnPEuslaSNIHwXjpCgSlWipDm7y8MJlzA2Av6ePH/97gQK5mHIFsrl6+ITeGmTu5xvWHN5L18uB63IJT50Jlg6ZAmLLOXoPbIMm2KVf7Nkjlwexi7hdZA9gFnBA1mAefjhwwd4lQTK5dsne3vgcp+7nGdYcyley5PLBwexyyTLSGXEUSbv64SlJgFLi57l7C4fnnPZKFca+68B5gl89BhYvoHWddIKVGL7/iXc5VV/xM9z5jJtb4kqo2NYSH3EEgolslyIy8Mxl8/RJSxWqwQmyIS8eff30woub/HWe/x1knmGOZfien5ddvxErQSWMrJEl2Ot6hJezyfRrL4wl9jxAzCfwpgX5P3713AWWyohV7bb1ufmEgnMKay5XPnfuzz3q1AoLF+7tn57a+feyqo4no+D1nmW6BIlYiKXMiIl1RJc6paV7ChYiMt9nHzGF0sAZqP69DXk6dsq9M3CmEmZ8VdJuMt51J0l5lwmjK5v3F25IUYZhl2xnZCl49T8UXsPRsbgCAmwlIGlGrLR/wOXWCrL5OJbxcoezJCUyw3IXqWEbUCVCuMyucuru1xj2mWIc2lnLXR5UOtEJ7E+siQh5z1ylDqJTFimbioVcArBk1pjdAlZY94uy+iyAr+DK1U0SQ58KiXom4UP8ddJPnmX4gbzLjHLG0hziB3r6HJsqsvB3WTSJWEJ7tIgAUqd+DTIWGZkc9ZoUV/ByGX+7xfNXV7d5WouXEKu7aw+GIRjl63IpD/VZXjVELKCnZqzWhlGQ6WqNQ+X/Hrr3CV9tnLiErLxYHjgd4ClkxjpilBiAx5uML2Lr0ipkdc0Q5dQJlGmrlsWd8ldLtTlaiE3LkHm/eEAPCZ676JSCX+hSjNiqWS5jP9B0iHcJXe5QJf4PDlyKQjfDBzT8QlKP2pUN9FlWDfNiCV2E6gXwtQxFnEJ4S65y0W7vFHIk8td3zQTAySAEUGG810jlmr6QtbATnbdtl2IrUYfUrhL7nKxLsW7OXL55YFj1lpjLmXM6IKUMrCUsi4Uiy2zRGWz2bRsHVgaBj/34S4X7fLGcm5c3jkwgWUrMW8ZN8WeXfoOUKrpzQSgsmkZgddue0FXcV2LHAJxl9zlgl2K3+fFJWHp+zV8i1zKkUvcX8YDlxhNS2HpNiXPH/ZevnzZGziBDTK5S+5y0S4x1/Lh8jtkWSMs/WS9jC+ypehnXqa7tKBYBv1bm2fSh0c6wLxKvw93yV3OmM9z4XIXWDrhQaxP3jsmYgxhxleKTY1mGIblPrKc3ub4dz0NXBcwR1Fmvh4ed8ldXjbrOXB5p4MsoyBMxzHlMObZLS6RZXrAJbJ8KSTTO7JHMJXZXf7EXXKXl8wK+y53Y5bxgJccJXQZdKULutUNVVVtV+pvC5O5Jdt4+oNfxV1ylwt0KS6x7vK7zjNg6SdcxixlOVzGSnraGSzGct3uKbKcTM9zbXSJfLlL7nJxLtcYd3nzAFnW/BHM5DLWxH4fr5vmEk3CZ1z3xemmMC2nXXfUuq5wl9zlolyKt9l2OSBdPq3YpR8tY/ENWYLLAFymBNthdWQpTM/XR7YtcZfc5cJdrjHtslcznb4PGpPL2Pa4Sy8wUl1qkqHZyDItQ8MNPfJ1LHc5v+92j2JAmmWXUC776BIz6RIfou2lkdqAbki2HQzTO4VfBrbCz324yzm7XFqjmPdi1+W2L9cdYJl0KZOO2PCxXTdxe5nm0lAt3etd8GfTrmcjTAXCXXKXc3NJoWqLXZc4ROJMsjRRJD4Ql3LkMqX5ztKPbl3UX7F9pBCXEnfJXc7RpbBCMe/FrEvcXjowRtJ3Jl3KZy7rF7m0XOvoJf4SCGnZ7Fu2cpX95UPukruc4nJdzMwOuy4dKJdOq+b7YyzrMiZyWUeXyDLhElsJdCiW7ov+LRGzlO5SadK71GKVOnF5yF1yl1NdCp9TzHsx69IfuUSarbBcxolcKpY+0XenWpauWU21/zjjjyZ0Sc8SMnGdyg98HctdTnFJ9bXfsuryywPTcbCtICqZ8OiY5jmXuqUkWHYlC1zq9gtgmdGPWBjVS5XaZtRHZFmwjuUuucuUNrvvKea9GHUpDJ6Zft9xUGQYh8algWqwm+CBeJbUPfZlXKoYiaTbNWzl2Z8fuEvuMsXl8o3seS9WXcIGs9bvo0siE5ex2S4l1ehqyPIXij7hvoQuVUmldYlB+5qt8HrJXaa7FHYo5r0YdYmNBWQFS+5K4sD7erZLS+12FehU/5h4ujm4xCUsYaloiqbbEnfJXV7gspBdMFdYdbkNfeumE8Y0Wx2/LstZLnX9hWYHQ7oVA7rUaF1CRs9huxauY/n1Cv6j+19+/r93KXxG8YWMuhR2B86zZyYEHge9oe+1KVzayDKR1Ytd0kW1iE0wbFmu+2uTu+QuL+JWWM0umKy6FK4POy0H0xpeh/1m0K5n7i/tR3ZfnEhhHi6xqGqK3SR5BC4fcpfcZXoZ3KKY92LVJcxg9nrD4bD3JW43vUDOdmk1u0PaHXZfQZe0URQboihSNwgCr/XnMe/D4y7TXQrZBXONXZdxNn3Pk9tJl3WvqyRd6nYzOOdyYw4udSyVSveofzr8+s72zeu7r2KXh19+EvfZq5TK3CW9y9sU8145cNkzPTmpUgaXxsSZjTbN5U76OtaaWhij6DpeZVbTMa5rd+XOML4iyavjE0AJNMHlNros5TnFCqa4V+EuaV0KNPNe7LsceF7bNMeLJbTJossETUNpdk9p/zf2VXCJ28Yky4RLtYswbdfV5NObAiZ2ieWSuPwCXJbynCK43HteKTZK3CW1S5p5L+Zd3vQ9DzDGLk0TXXYVJdvl2qXqpTIOU8U+BbyJgnd6XRDSXML+sloqlvMcXA7s7zf2uUtql8IKRcFk3WWvji7lOFg760eBhtvLhEvjnMvV1P7YDJeaBOYNWBurta+Fibw6wRwfH8PjV8RlngMuYX/JXV7K5TrFE7Puctj28ErOYy7hb/+0LVlQ1jJcijO6lAzD0nVNdyX/upDu8vefvoF1bM7rJW4w+XnspVxSzXsV2HZJlrFmO+HSM4fDI8kGQFkul1PnvNQMlyo2Khj9af9Fr+II4DLfLMvVYqUM69gqd0njkv7fucu2S7KMNRP7S9mr3X8sgxpJynK5PptLBVyqtmt0Mvsf3jYa5VKeUyyG69gid0nrEnOPYkCaaZenntdOuMTbRA/En70muFSzXC7NuL9UDNVqSn2Bu9yHcx/eV3A5l3TzXvdYdlnwA69dT7hse95Q/Bg0XS27Xt6e0aUuqU316KaQlS/eNvbynWq1ig+N6g/cJa1LzF2KAWmGXd4yA68OS9extIP6X6KILnU9y+XGjK+TSLplybsChcu9ved7eU61Wqxyl5d3WaAYkGbY5akXtKFYjsfzfJG4lLRMl1uz9RVIku0GQ4Eiv/3waeTtD3wdS+2Sdt5rnVmXXziBh40EdYwJAZcBbC/JOlZKxKZ3WSAuAaaWbLElN81UdF2TrKZ6KvAkwl3SuqSe92LWZU8O2ugRUcomiRfIf4jij17T1VVjvD/2kTGgfMLNvupKyrkb05KmWNXCy7i7Vr0g8HCXM7mknvdaYtXlwPPkyCV55ZK4rImRy+RYtEvtskBcKkAzEVXVNCO6GZi3K/BwlzO5pC+Ya4y63PbRpQwux5oK2sjvZ3Bp6ZquRAGXzSkud6a7bIFLgDnpEnTrqqqGm0se7nJ2l5gNinkvNl322oEXTnaNXLY95z58p18mXUqXcLnpWOgyzPilLnXdsgCmq/PNJXd5BZf0815susRlrGzWxyK3sVyGLlVJS86T0Lq8I9vgUppwaYBLC6I27aPrAg93ObNL+gHpLSZddgLcXhKY+M7EEa96T4R8RJfJyzo3u0PKJ+wFri0p0uTBjyEplmrZVjO4JfBwl1dxST/vxaDL7RouY1FjvLv0nK9EyM/oMmX+MusJe3XNViRl+jW2dNft8lUsd3lFl/TzXuy4/Ie9ewlxGgjjAF4VvAoeBPGJ+MAHPtBLOufM1VuENAQ8iOSil5ae99y9tYjkIih2q4iH4uPUS0FBlBWs+KDKqjcVBBVfN//fZDYabTXVkX5Z569Jt5t2+S4/JpnMZLbv2blr16792/c8OhNFXXrYVfd+N82ZRwdOnu0/6rbb8an4W5pxuzFz88m3bELeY0uDX2Hb8+ThYax+GY1QeSSKaver7cb5ko11acJlrgUxi+Ly4eFu9/79+9BYbY9IXMVB8KnX29jStOtBKwbb8v1y+f4vcuZM9xQN9kkk/uiyjMldh7eXbKxLEy5zLYhZFJd3TrXqOhX3eIB9pSKl5wlP7fShQFYQkUYGEp9VqdTHB67jZiMauVI09cfG9haJdWnMZb4FMQvicqZ9XAqdMMTOdQVefPzkCMdRCCUdcnEgDY6HcJt+TUW6lcrRVK4AamJZPZG9d5kgxWRoLD8S2/F31qUJl/m/fLAoLuvCFUcdoPMdxMc+T/xky34cLgHTp4RSgmWzXKZpKNlAqXIJlo2LJRvr0pBLZF+O+V6Fcem52uXfBi5dQS5VI0ssa7VfuIzjma0lG+vSkMucC2L+fy6PIpolncQ2iOWIB63DJRLZ8XfWpVGXeRfE/B9dQqTv4K8RywgsR7nUgwxO1ezFpXVp0GXeBTH/O5eOoLZSs2xGXXJZrY5uMHFX83TJZmzsurR5XU4+3+t/c+kjcOkeJZa1Grn82aR22Th1Zk/Jxro05jL/fK//0qVmWa5RyqNdqgce3CnZWJfmXOaf77Xj/3MJlkLfIEnbypE249i6tC5Nusw/32vDf+bS8WlYwiJLXFhGI7ti4TI6EretS+vSrMv8C2L+Zy4FXBLLKoYTIBG5rNVGuCw32tZlybo07DL/gpjFcymE4uViE+oHT2mj8QLj7o44TnIolJJYxhFYUsrjEjXienumZGNdGnWZf0HMIrgUru+TS4gESSmDzmD25wxawUiYeiwBsQyPy4o6iS2PQxlFR07UumWw9OrWpXVp2mX++V5FcCmUSymlairl7KVzt37O3IWO/J1LGRBLZHxbCZcYgde2LqdPgGVRBlzmmu9VHJdCJg1mcO3xjefPnz94gB29YKPdwtwwGH0em57iupVk8N14lwiOEsuj1mXJujTuMv98r+K41AkuXH/34O51lbuU63evfPz4+cGta8HY3h7SeVTdt4xqyFiUaCyjBrEUwrosWZemXeb/I/sK41JK/E9cPn98aT7JJWT+0vu3bz/eGOfSVy5dQSzjarlGica4pEOniKVvXU6dAMuiDLhEDuaY71UYl0JFwmXv3Gyr1Wl1Op0BMrzz8tXbL71fuXRd1/M83CDBQHXlcgxMai7b9YoUtr2cPgGWRRlwmXO+V1FcIlCmXF6d60hKEMigXr3z8sOHN5+ujnHp+2CJVNBcVsvjXerEYOlKGVqXUyfAsigDLnMuiLmxIC591R8rU5dCpd5Ea/nhyYHHl2+PcQmYklh67ViPvhufCCw9NwxD215OnwDLogy4zDvfqyguReqyB5cCP2qWr57MXHj6K5ehW6l4lXZDu8SCeqPTUD2xuKECx9Zlybo06nLiBTGL4ZLiwOb3LoN4RrEcXLuVcYmDmRw/XsE9kgj0qipjWs2m6omlwe0V63LqBFgWZcBl7gUx2btMxt3paJey4sl6PPPk1auXM+3WhdvfXAJvazAczmZC7xu0mh6xHHk6G0VgWRFqEIJtLxkQYFmUAZe5J0jvLYRLSTb91GWFnv868/LNm5czcUAu034ffGTYP5dm7twccm6uf63ZJJjYsMtM66ohGBSrTmL1ICE7rmDqBFgWZcglggbzd2Hu0ktchg61ZeTyhnJJrSVY3omD4xmXjgjmX/d6V3UuX768cBl5PU8uySEle3sE0SwXY11OnQDLosy53Lx0XDpguejSA0u0lk9ON4PjI1xe7eFfCjNx2WgqjpplRmVXs7Qu+RBgWZQpl8iGpeEyJJfp9aWnri3fPJlpg6XMukzOY9PMLZ7H/sKlYikc65IRAZZFGXS5Yom4dN1vLgfEEq3lYbCUNJb91g/9PrM/p9EoJx5/dKlbS8i3LhkRYFmUMZfI2iXhEvFTl7P6Bkk7kGrQ3LVnqUtELRyECJkE72nmJa0QNMqlvra0LnkRYFmUSZcbl45L3R97bkgsX4Kl8ue1frp/SVrxSt+kH0NXuySRWZblSF9bhtYlKwIsizLnElm9ZFwKx6VxeOsfvXz1BixxpILry6CF9jI7PlYgDiX5pgwlPUBEN5UjWSL2+pITAZZFGXW5bKm4hLXwOPpj72Go+pPDcd2TMoDL463huQXVXmZbTOUyFHokXr094iwWIZZoUWHR9sdyIsCyKIMukb1LwqWz6PLFW5zE3pntIK0Wpnsd61zQ57EjzmS1S7Wu3qju2GbS5RPSYAJ7/5IRAZZFmXW5cs0Scek7Ei4/f3n79n0fs6LnFzN3vZd1CZCOdukol65HMKMI57KZUXhNdRJrXfIjwLIoky6R3cV36cMYQQsuvH73+ePH3sLdhYWFuzpXX9xQLsfHVc8RiQkm5mB21Vpe9xdnkFDseSwzAiyLMusSDWbhXWqWMrh2u/f8wY0H34Wev3V3biidX0fBbNCskm63mzx+CywriUbb78ONAMuijLpEli8Bl1K5lIP5uXM/p3+h83uXgEkyQZO2arMNltYlUwIsizLtctW6ortM5kUjQWcw6KgtzQBvW/L369K6FSUzjpuNRjNGYwmWrmtdsiTAsiizLpEtRXfpCB0pAdQVElIFbTL5bSCd38XFn/E8miBGwavnuW7oWJcsCbAsyrRLNJhFd6lOYpVLcFTBqwOuCVn5e5ch4mL9S2XTQ4QbhtYlUwIsizLsEtlccJd+4lLt/NQladVx8rgEQyWz4uGuiOtal3wJsCzKtEtkQ+FcrlqxO+tSaIU+Nn1jQ2vVLvPYdJM4i7EueRJgWdQ/cLmjSC5Xbdy8j+bBZFwiQhk8qn6nQu/zuvQRJ4mrP07IrUuWBFgWZdwlspa5y1WrVq5ctnHHlm1716YXw5nry/QS00Pc1KWCmc8lsugx6aEViHXJkgDLov6FyxW8XObIzy51Fw/hJJTYHPXeyRNfJXPnBE2vPY/lSYBlUQZcGm0wp+jSS1zqNo4QBirqVVLUCw5OHsi015dMCbAsyoBLoxOkp+gSJtWmLyNlQE8JGXQyGcx2gglh2n6fEm8CLIsy4NLoBGkGLmXSxSM7Fy71+/1LmeD9sCWsy8nCmwDLogy4NKpm+i59fZcE49YXrl5eQGinc7V3vT8rrcsJw5oAy6JMu9TZd+gPM32XiJNdL5p2Opdf0Lq01uVk4U2AZVEGXBqd78XGpYTLF4/785cyoXnR1uWk4U2AZVHGXepsO/SHmXp/rO9Q0vWiv0+ng+duWZdTj3WpM7nLVX/YYE6zvUxc6pDLq/2OTAbf4UX9bnjOupx+rEuV8S7Nz/dicR5L+bZetBpkoNfBHNr2kkGsS5XxLs3P92LgUgpKul40QjCtSz6xLlXGuzQ/32u6Ln3aNMzEpR6tTiiRYORznfPHumRIgGVRBlyane811X4fcukoPqlLJNWXXTcIkYsdQq0cwacCpdu6ZEWAZVEGXBqd7zX99tLxU5dX4TLzpNgfXMrhpf5EmR8QTLvOHisCLIsy4NJog8nApfO9S+dXLoP56zcmyIMbj68FQkjrkhUBlkUZcGl0vhdjlwhdX2ZdYh333On14FIKxLpkRIBlUQZcGp3vVSiXcna+f2mC0HmsFLbfhxcBlkUZcGl0vhcrl73fuBQBrSiUO/hwYK8v2RFgWZQBl0bne3FzKRKAyfbT/Us5acillNYlJwIsizLg0qieYrkUi6HDv4tApLDt5Vf2zu01jjIK4AM2NKZSDDZYtYI3xBdB1BFlP+bGdNkB18sM5MFkHIxjGsqWJn0abwyCO46S2hUiPowFSYNtsIp5UCsqguCDStVQEEopWh988aGi/gGeMzuZ3SST7E5zMrN19tedL5t02/1S+ss5853v0msK9GSnyLxM5oEHU9KbXgKoU2nd/FgULd30gnK5X7/sLQV6slMEXpKu9+opL7F+2b4PF3r56xovU2tZ7o/H9pYCPdkpAi9JD8TMz0vU8ilsohk+a9d5Iafi+mVL1vhs2m4IX9/3sqcU6MlOEXhJut4rJy//euX98bHYy3Kpuf7y0vnTi4s/tlhcd140GLY1Rt/ve9n3kthL+gMxSbx8PuXb/fXgg/8svj82Vlq7nuTvr/48D/z5Gfz6M3z606Vf0Esq0MvH/+H69L0k8JJyvRe9l/vmDx++ON81h4H5+ZOLc6hlGY6pLDdLjDBH/fy3v/8Szp/DFi7g0u8fnbxAus5r/MI3UU+g092zjyswfS+36CVyR7ZenqzPzJhWsAYrCccJmjhTH7zzerlUPjAGrOwgW5795ofzGCRX8xueF03HU+NvvuU4jgWdqEDTNfUii9n3ksBL7pZMvbwYzDhN4dZIGD1aOC1eRi/LT6OX0Q6ycM3NLibw6alx0n2d0UvUciYwnU609do6zBWXvpcUXt6WpZfP14PA931e15kgtSMIglSFaz2+//LR1z4cHy0fOFAeBTujjZ2B8fXgEkpKL/cf+PAtaWpaNwxDFLXNESUkfJkbNO7nCkvfSwovuVsz9HJfLTA8SRQ9z5M64XmyLAhMUY4efe2d8VGIl9GQD14gZnx0dOsYofAzUg68+dbE0aqgGwrrhCDHqMHMPFdY+l6SeHlNhl7Om46q67zoSZqmJKC1YDrAVNUwpsDL18f2P43Wtcr/8ScYPpGV336E+P6yetDzBEVRO6OvAF7W7uaKSt9LAi+BmzLz8qTnmirqVvV9xUhCiVF5CJYMnrhTRz9AL6Oh2DBKAtEnsY5RBKX3UgMvvapSUZUO8HqMEVjHuD59rg6+E12IKp6nM0lSWIzSgrUQJUkLOYhe7sd4OQpNU76VE/WitDYW9BFiwEt/SvAgvouiJnUHhFfBDOrXcn36XA1cO29CSNQliVckSWAxeguhxYq06kHIYw+USk+XR0fHDkTlS2yQ+I4TeYRcTIyX01O+qPm+JnYCX9REFNSgVuRSSZ+riWM2eKmqmsarTJL5FeRkbMZktFOdwnEfnO0zNtrMZSMZYy1bXiLU8ZJN+XgzLIky3wFlBVEQKoUulfS5iri5HlT47rFBS0BRpp6HOsn+Z54ZG4s1LMdnHzTBj9GnJerxWGFKk2SmiHwKBF0Pavdwffr0PlAkUdN4CYE02ctyc5OQ2STmxks94CVjslW5yPXp0/Pcfth0XCovS+Vzp098t56TMA+vB7xUFcm16ndyffr0OvsWHJMn8BIAL+G86K8u/bKGS5d+hXnrveGl71T6pZI+vc/FwNG27mV0/xieF33p159W8wmeF90LXto6eBkcvp0rIDsfuhKGODIGr6gDO7gW1w08lIadHBXDqd53kCPgvtqMJVPEy1BL9PLSn2u3hz3x01c/9ISXul71zUAvZKkEvLwyL4gYIXj/dH/H9ddxNOxN9ba795IUSazA0Am8bD8v+sK5Vcwu/vBRr3jJfNeyCjnyc4VeDnNEDBF4mTJw7eJoSBembyAZ9ZkPLJ3Ay6Yu8bm07YzPXTjRQ15qhlUvYqmk5WUuQWfHQwReps1k93AU3JB5FotFEkfRbQIv8YJmxUt8vrK0ZO7T33rES9tmvl/QUgl4eUXcSHSLRuBl6kx2gOKHyo7dqd5zL0fBvOMITCXxEom8LCHx/PXxnvFSVWXf9yqFnCR7pV4OcBRcdz2Bl8iuzLPwwRzy/rtqjiooLkUeC1fsZWtGLD5Z7SW6mpYSWbxEL/WgUcBSCXh5ZYxwBNz4EIWX6TPZkYx7PkA0NdaHcEniJZB8/mXCuUHnLsym4Vx0bhDF/SV66Vkzda5woJf5lUoGSbxE9mTpCQb6HLLYO+umK8mKso1erouXeF70yRMnU/Dj7DiGTAIvBcH3Jckzgtq9XNFAL3MrlYwQvvmuTEdHh/IYvd5XsURJZtvrZWndubTnP/rko+759YfFuXKJxkvN1wRJMAK/eCM/6GVupZIhIi/TR7DdW/upsifzcSYEiiSyKDOWsZd/4nnRX3XFJ/A4vzheorm/FH1f0xljplMvXMBEL/MplWCRhMrL9K4MZpjFjpCtJDFBMjljLy98cyIFv504PQvhksZL3KAIUByzcCM/6GVepZJhOi+RXdvX+9xHf5GLlqUqqiDztF52Oi967txs2nGfMpGXoqxMTzMGmWzhlkdvwcuBvIok6OWW/77r02SyuVdLgXvqgS6ohiDb2+zlhY3qJKXOtF5J4KXs6cq0Yui6Xrz9RNDLfEolWGqgHXTak9GAcqY1mZiLFcvzmCHYFXov4wMwE70sdb8bF1oc7U1C4SUzFN8FLy2raDvJopc5lUoGSL1EhrZrOl4PzMa9sx6YnidoTFVtai9LIbGXa+bHRrtXdkkJIPLS81RDkzRbl12nVrCt19HLfEolI9TvjJlsBgNXe3fnkMVikSQwJc+TFCPdPDzW2UvwDigB0CSf445e4qMj4R9IGI+tNr3U0ogpSYYBDZNxGWbBSiXoZT6lkiFiL5GdGYSywVyy2NvnHcfVBPCS8S0Yg0tFeDEZXsSd8nhFCc8nKaN7+1fsidZ5zcKJJHPj0OADrrXrvFrBtFs28FLgXU0Tk9C01kfGbJ4hvCjD9yUJTJQ0Z6Z+H1cktuAlRhyCIglppB7admluTKk+EffXHNNgeDCQKLZ7aduhl4qiKVoyIo9eTkdePhV6+VTkZeu86MWwwQ+LcF40/X4FE+il6/taJ0SlyvMMzWym4U3MoFGskR/0MpdSyTCtl8mZLH2SuSOHLBY55iZ4CYCXjKk2r7BkFIXZYC/ESzyfpBR6Gd8BbriPyG/kXlanmCyrrpvYT1tVbWbjt4JUq+gj49sxijbyszUvBwiKJLR3tjvpEnGioSWqqbGmoaKXYvstWhRUGl1gVPGcvWeewmPcox1+0Es4L3o99PtufdwwGkCl0QkbvWTo5So1VdPyCjXyswUvkRGCIgmhlygO0YRymhtYKo6J4CVjqKXm8i2YKIOVCwu1mg00NkGZAC/HMF6OjUIbeTn740mYonMCrnZwn0pqL9XKwkKjsqmY4XcAOoagmy0013EKNbdgi14OERRJKL3ERJNmOh7NgC8Rt9cdU0UtmaK5bnsWK9oL3sTXh5p8vTHwkvq7r2O8LEc74qGYsGvIqXPnTp06BVcMfIV6X+d3PvgaOrdp77CBVm7wYSpbXS2mqJkzC0WaJIte5lAqGdm+t71xGxeW7Moni8X9Q8BG0JJpLnrZorLgTR558ckmL24MvOTnH+dGo3iJoDBRdaS8ftIOpZb7X//x5xeffPHRzXoXceSQVJGrCINstt1LPyhUqQS9zKFUMkTvZczQti0sGckji0UOmw7fPJyLXwWzl7zJJ89+jxw/Ds3Z9XwPv6C9vPzH6Tk0MvJypTS50iDhJ2gpsZdzp/84e/zsxkDnl49D/5eXvzjy9VIjlBLhW2iaGRRp63X0MutSCRZJCLykyWSHUmSxAzlkscg9L1iGKAiiyPg1NJYOPXn2zJnl45cvn+lE5OUYehm7GNoJlFtaRk8JAS+XO/Vuufn499DSEpZJqqu9tEFMq0ilEvQy+1LJMIGXVJnszm3q9U6OjGMVS5EAkedlXZfbtZQnvzhz5nsMlS2Ot4NxFAm9HAsP2tvf5iUKGNmIT+LElt5L+IW9SWQl3i9fPvvYxFKDRy+had+CS5LMIpVKtuzlIEGRhPq2dnBb4trevLakv7PuOBpqKYKW7V7aS0tfH/n+DOaACUYiUYK42ktskbYJeVGURF1LIfReHl9GL5PFjPW8/P2/k/aSDV5WV3tp+L5fKdBOsuDlFhkhKJKQeomZLMF9IIHtZFNjHVcAKzFcyqu9XJj8F5I/4PLl5TaOrxB/Ab385u1yeH8JDmbK02+f/gN6iZ28nOjjMhJG0zNnzh55FgOmuNpLW3XBywLtJIteZl4qGaDzMpkbtmHc9IZcsljkcGDpAp/EQm3y3y+65Y9vPn/ppZeey56XPn/rSLedPPtFmMjizSU8Woiq66pB/S6uIKCXWZdKRrb/PQcJZssRjCaRcE8tMBjjk7C9Q5PvTU5OvgfNJoS/+/DkC19++eobr+bAl/XJJ96DPnbkvceOvHdIwEk/bPVUPFHjDVW2vMKM/KCXWZdKhgi8JLVomDyL3cHRcbHiKBttGgu1PkEWqs/Ch2oS8ZfxRaJdWwBq2eNNSNKzz/rVDZCwo+E1MTEh2Hx1XUFI1ETD8FyzMCM/6GWmpRIskmQQo28gno53Y25Z7N11xxXdZC8Zayx1jzH1/MHpgwefz5yjVexmsNQVDdCSZ2Dpqvk+kgReSk6tKCM/Hb2k/184TOElbXwbpB1BHuIIOdYINNFVk71UcIkXNJtTqeBVMaaZquISk+lpJVOmFddEjA59RGwejAy9ZKu8xHjpFWd5NIWXgwRFEnIv9+5OPR2PcA4RHTfXA6vKb4Smab6vdYeAiKKWPa7rPzs1PT3NdMa0ToRasrCC2cLzeNOQJDOo3c0VAvBy64wQFEnIx5puIFRpT+ZnncXsa1hGFZc2JyFqkiQ2kbQkJPgy3NlJ+FSQZaEqNf+IlCmhbpqIHZC0RLBX0W8x3kYvsW33smL6fpUPrILsJIteZlsqGSDykjiTpZuAN8hRctEydMbLQrKXUsvLZHy40Et4hQ7g/3UYBMoWoSripHt8JiT3M+p/2M3mJgVsrZeq6ZtMMGcKMvKDXmZaKtmT2RvuJQtyu/LKYnHUx1JBSk3jN0DG1V/wQdyQUF54JWiJewLYkM3q2cJkXkYvIVon03SzeR/Z1JExe/WWlYqrGYYnOwXZSRa9zLRUMpSNl8gw0ajySG5ZLC6IBi+ljcZjbdVWcRsRtgm8ba+0qua6CuST4EiW8DZDBDzYQGHJNEOkDU04a339kXtVSTZ02TMLsvU6jZfXUxRJ6AP0AE0ynmMWe3PdqfCCpFVUPhEGXur2pl7aAEMU1/V9eGgioGUIemnzcOH+Ppt10kaaXtprvRQEWVdFyS3Iai/0MstSyTCZl+SZ7B7KASS67bZsSP9cW+eTsfGCpjvE8LoKkXWIuzbvuq4pFqJUQuTlIEWRhP6GdphgOt6OlAUXUuYdixeqVVfX+UITraNxAb9+O/f/B7wkYSSrIknsJf1K5l0Uw7qk3Fd3DF6sTmuyzBcbOfwXUDBgFmJjPCovd2VWJIm9pJ8iP7LVnyS793KkHPMtXdZgeo50VWaf24FiVopQKqHycvd1mRVJYi/pM9key2LvrTuWLmjThiIW3ktF4RGZNx2vAJNku/VycDdFqWSokxgDabykz2SHE3qcTxYbnxXEPNEwDFHii40SeikDqmUVYOSnay+HCUolOzrGG1ovkZEt5aE7Uy5LoWU+sExFkJhhFD5ehl7KgK4bQQFGfrr2cgdBqWS4YzJM62X6yTqDWxk+HuZouf8/9u6ftYk4DgP4b8hhTUNVEjGIi7i4CCJEbjjSXAik4dLQXuZwoCGD2EGnQIZMPbqI2bOEvhHJK1C6KXQquPgCXL3EQKC53OVpv7k7rs9DdbPCwad5es/9ccft6lmlUqbL/zHnMGt34e3RG7tU2VuXuNxe6Mkj0KV8k31yc9OaEs5lx7ErZx5Mgy4XKOfXODn99J/52dxlAW1x+KnNIuxSvslmgH+Jtlh0JHFqrts4q7jldvWOuzT/Z3FGdjxK/VSyuUul3XYq0YD/A3Ap22SzAueMpG6IdmzXLQ0rFdO46y5LS5a1UuMO3B4NuHyCTSX4SFLYgkvc1z2BjUUk547TvfPXE6ym63X78ce0v0MIcJnbg9Y7fCRRiEskhRvdWFIEr0kQzku33+6WmOuxPZf9g7TfHg24VNhUgo8kAi6BJhvax3dibbHqctiplZiVmOVytTM8f6BSHcQlMpXgNvZy23OZe4h/9OWFH0GLXxrbMUrMasqGMRym/UmyiEtsKsFHEsgllgKMLLOHUZbO105/yF8ufePNucO0TyWIS2Qqwe9iLGIuweyipTQbb4t9fjp2unTpl1q7fTjsn6b7zA/iEppK8JFEwKVUky2qe/G2WPWsO27bdLnGZaPRKaV7KkFcIlMJPpJs1yUGbQf9hVQ852PH5kjiF6Parp6Vap3TVD9JFnGJTCX4SLJVl2gxBe+nFs+bj+MDs0yXPqnOnjFvms4o1VMJ5DJ8KtFuPJIIuBRssjG3WHU5Hu+7dOnv0uiWKqYzPr2v0hvEJTCV4COJgEupJgumoMTz2h133ErFZFZjVA3TrJidfinNUwniEphK8JFEwKVok8VbrOxIYrtuZb/M+GTftGt2rd8/f6pSG8QlMJXAI0kULjNAk0Uu2xPP0/N+x/5YbjQMZiWmWTXstlHr9NN8bQHiEphK4JFE0GX4jWYJb7Hq2anTtu32cFhj/GLYtve3M0rxVIK4BKYSeCTBXSajye6qLeRy/+BgNPJcHjAr6XZrJdPsdu3RpxQ/TwR1GX5aM48/glVTci7DX++e9Bbr1dizw/e2/eHLu0PGL++8HB4a/Up6iyzi8qZTSXGDkQR3mYgme09tIS/fnZycfDthQvLt20+V1uAuM6GlFB9JInOpdkRZZtU2cvFjMpn0ekdMUCZ6r/dLpTWIS2AqgUcS3GUCmizQYkGXrVbLmn0xgaHLGTZgKoFHEtxlApos0GJhlxazJt6xocsVl8BUgowkuMv4myzQYuEeO51alq7rFnM93kGZTqfesaHLBR5gKoFHEtxl7E0WaLGwyyOPpXWkM77xXPa8IzSZ0OXMJTCVQCNJtC5VPtktdu5StyydCYDp/dHpcuESmEqAkSRql2on0S127nLW12hzbSyr5ZVZuly4BKYSYCSJ3GUxuMniD2any+DQZQQugakEGElwlzE32SdqGboMDl1G5PJx6PQBjCQCLkWbLH486DI4dBmBS2AqAUaSaF0WE9xi6ZIuMZfQVAKMJNG7VI+S22Lpki4xl9BUAowkMbhUWmJbLF3SJeYSmkqAkSQOl8XEtli6pEvMJTaVACOJgEvRJov+NKHL4NBlBC6BqQQYSSJ3mdMS2mLpki4xl+BUAowkMbhUjxPaYumSLjGX4FQCjCRxuFSPktli6ZIuMZfoVBL6vQuxusxpiWyxdEmXmEt0KkFGEtxlTE12r6hWQpfBocsIXYa/1h0ohLG4VI+S2GLpki4xl+hUgowkuMt4mqymfEKXwaHLKF2qrOAjkXGX8TRZ3xZLl8Ghy0hdPr6dy2L8Ln0vfMBf2E6XwaHLCFwCikK+YwJc5rTEtVi6pEvApfgzHwtJcKkKbwVe2E6XwaHLCFwKvYJZU4lwqXaT1mLnLnW6pEvApdzF3/mEuMw9FHhhu7zLFl0GsfRc8nl4611mbjGSJMSlygq8U4+fl5HGY0mXS5eSU8muoku6pEsJl5JTSZEu6ZIuRVwKTiU7ii7pki5FXApOJQW6pEu6lHEpN5Voii7pki5lXMpNJXm6pEu63KbLzI1GErqkS7oUcik2lewquqTLW7jU6XLFpcBUkqHLEJcT3QvfS7v2tbTzw0OXQS7xqSSr6DLQ5XQyS286PWJWM51/eQeILoNc4lNJgS6DXf764cXSp1aL8Yuu6z/m+aPSGsSl0FSiKboMzquLi4ur75+Z9bm6mOWFSmsQl0JTSZ4uN8jTq2a9ucygySxSb9brv/+qdEfCZQYcSehyk1w1j4/ryxwz89TrzUH9+Hd6PynlXKosNpLQ5WYuB836tTT5ddwcDAZ1ugxxiU8lGbrc1OWgvixvzCJ0ubFLpSEjCV1u5pIW/7FnxyoNQ1Ecxs/QDmZtu4iL4Ct0C7EpGTJ00jkUOjhIJychg1Ohm3kIH8jVF8gT+ABaN3ub23NIoJfL95FHuD8O5N9deydxZ3TZfyqZ4lLvckVOfzeTe+l1aZ9KxoJL7mXv2luJO5vL/lPJBJf6/7HU0XcrkTeQy5F6JMGl1uVL/W+0rFc13+E7xL3UuZRE+7RxqezriTr7lMgbyuVM6QmX2m42zxs61WK/30nkWVz2F5UILrW9N01TktvHtlzvriXuLC77TyVTXBpcVkVRktM2f8Olx6V9KhkLLvUuy2pJbvM8q3DpcWmfSia4tLm8J6csw6XF5UgxkuDS5HK+IKcsS39dXkncDedSkvPvGpe2e7nI6ETVKy71LmdnMeHS5HL9uEzpOFx6XdpRJYJLo0tyS3Hpc2mfSqa4NP+PLeioZfqAS49L81QyFlwaXRZzcstx6XFpnkomuMTlAOW4tLoceUcSXOISl5dwKYnvUeMSl7i8gEt/uMQlLnGJyzjDJS5xGV64xCUuwwuXuMRleOESl7gML1ziEpfhhUtc4jK8cIlLXIYXLnGJy/DCJS5xGV64xCUuwwuXuMRleOESl7gML1z+sHcHr4ljcRzA/6ocBh8vL48YmsO7JOBhqi4mEUPwkFtRDPbgxqSQsoUtvXjsTQqCJ0HYf22/v2g1O9NOO6e18L47Oh3zErvgZ94v7/foaJfa5eVFu9QutcvLi3apXWqXlxftUru8SJdRZNWJLC4QblncMkzTxCGGHD679ThDSrORnHN62TBwHobP7TneQBrH4JUIobON+mV6i8iWEhe2j+9p/k4Yruma9Tfz8WDDtm3G8My0S+3yS7qEPZELDiqijsU5ALiMDinFDESYlgFUTMq5+xozz4GYSdswBc435/PeXB6OWAgXLiMajFNMKRnAgyXRntt25Hl5nru/EVgzXeFy4vzxWOn7thKG7dufmDC1S+3y/3Qpjbdiz+dF4UrflqZbzF1gkj7+ZLy6ZMyspUUsTW1bngLCymR01CQsRnRlKEVmBK9zOMsUiBlFXCmCpRh8ASk0YIj8jUSYLkUYKsnkhzEF832mBKZN7VK7/Jour+w55qEr2/dR+82htC4BI4OdcigeGVMy8k6hyROvkT/GMP9ZHNQQEhxZ8FsUqG5BvZjP55HHuesWAuGuAcgMOCXzfiMQBuOF9Hu+/dFYziMvMgRiGNqldvklXYIUKP2F+B5jVAVGY55bFkAey1yOZ0Qp3oyPSC64wWQKKlaOc6wD2TRNYyQIwyTB771eqnAxzKQUV1KRi7IXZ38+FuxbKIFl748/Iot/EBZ5HlwGQljapXZ54S7frulgKYrAzvP9lKUhIoJARTVJPBTjQCWldE2uVHgOhqdKCc7BUAKNlfPo6opeTZJEccPMKVyFcZxlcSyvIoPXLA2uAlHMe2ka/kZS3zO4Zci01/vE4JQpRSV0zrVL7fJruuTGVS+cTCZJlk0mGYLfUj+qK1lyiSiJyc6E1yo7hc5Q3BQ1WkY1Y2T3enE2Ufl0+bDZH7N5WE/zIMtCFMGMcSz6MPAuiiJMJtlvJGVwyYVKqs+cNqmqxJ3j/0271C6/qEsLReXV8zh/Rv56vhojtHAaRWQSDyNi7OAyz8enPD//OX4emwbaIVyYpghxH5lmWZWvHxa3Ty/3u2PuX1a3i4d1Digod2FTKqVEUYjxdPo8/nSeUR7bjFvj8Z/0vr/M8bgpadlXu9QuL9zlO/eXlgqN9WZR5+6uftovc8UiQymGRF7E3HkhRDBe7u+OoXH7h6lwUZ9S/9KVRZFUNOL2ZftYll1kRCnLx+HsfrWBzCz1oUspzmQRPj/gjT6f/fKZ21I9LzefOG2xp2/uOfV97VK7/KIuLUsl44en7Ww4OwRf7BbTQBmGwoMZtcuiQBU7vdsNT5lt72/XVSxtS8GlfeUnQb7eP22H5chpX9fpINftdrdbDndP+3UwSWybCXIZVsvVbjb8fHZ301CmyXT/sv3wtNlsu93ubtdhjAlau9QuL9zle/eXapI/3JdOt+s4eLruOM7jahmEcAmUGEFNkdrl8unRaR3T7o5mcJn2pMo5R5clDaab1f3jCCMGg84ALNvtdqfTwgNfQ+bqYVrFxVwI7vtxsHzBtZppU/D8nz++xnnEe0k/md5ty67Tbp52eDTjOJinh0/LIEul7pNol1/TJXNVVZE4GGp1aI5rOeXLJkjQyGcGPTGaLl1RBdDbHhzTue5u9+MKy6qKNvL4sVov7mmufOV0YtWmwTejcviyWAdZ4eZcyvAnlwiuirMawZ9f83g7raRNLkfXncE5LfyiB/47h/4ieHxaVxm+be1Su/yaLjkPs+lqRi4PlL73y91iHEvGiaXLPCYK4bEsWMxG317TuSnvH0Tl9lLPsyI/Vcvb7d/dEa4yOLF0Xr8C9evrUbm7hRWZ58JVOf4muG79HMdp9RHM3FQGn18fwmVoqOndzBkMvp1yhtsMXDq1y1S6H7L0tEvt8gJdRh5XmbXYdgcDCILK760+StRpnNb9S8OMPFbULse3Q+cs4oY++YHb89H/lDXLkiDhcfBFKOliLdIOl7BSw4wtIRRX5NJp5Geh+NU+HR7erpNEJXDZbbpsIzja/iE0wT4tq1gyQ7vULr+oS0tlIZWoDZcwl4QGsyyTBhjkUlXr1WP/7LILu1UoChsuk2ANlg5Oh0P86h81nYm2HcICmOBVzD2mUMeOTp4cB1/32yec3+uQ6GMOLsNqevujS+QtlrXLhHmWdqlzyXnfZcRFXK2fStSdry77qFFVYjPqgGAAg0ueYNmnbFSQo90+n8Clb0eqovWYV4jfySJCODsUvNo5XNkpt3fPWXzlsaR5f1lPp20H9eu3M8zWfwKXcah+ckkj6/H0OIUueHQZaZc6l5x3XZK+cDK9HYLJyeVou8kTKeHSlcxmbiFYkm/uR9/OKV8e1EQJ17dZNd7cl90bKihb/RMlfFk3SqhchTqnxlbeb/Ks8NIQdex/7ggBk1zCFP3t8FOGVFjz5EeXB4Z4NNMa4O2oyo6llNqlziXnXZeSCUtO8v12BJf0SSeYzuyO1j+ZCEPmedIVIk3Gi23DZb98Wk8SJcy5TAIg697c0LTn9LHKgxzKV4BERlhCBc4+ZrVOl+axylP1CnDDJdIGTAyp69LOIecB1CdJLXLpNF3WZTMFNv+jfFS79LVLncvO+y6lsIw4eXgp8Ymmj/o3xBmu8LG2PSGK2qVphsl0hbnq7HJ4O57ELlzWd32jm5sOiFDPkhZSnRG2+SCPI0rdE+0T1Ovr7mzxZyVksXwpnU4zoDV4bVx2KET6dJS+n5AntB7bataxb+YaLsl/aGuXOpedX7nMrXSCRZ2DS3p8Oyxn+h4vyKXrmlYS0grqmcRouw8mqQu4WbB5KbsHWkCJQMWM9sXerl52s8dR3YGBynofkPM3Gv5hAZdkthn0ITuD4yaBmw5t4yvPB+n+MlEHl60zy1H5d/l2ZnibxIv0eqzORecXLs3c87PxAhXiASW168vdJoRL8erSSBSWbBsusTKUpD5cJmh+DkftDqZChyY6qCxnL3eb5Xo9XS83dy/Dbr0eBJht3Gd2usO7cRWH69VuOztluyW/58rV6T7ipcaA+8U0DA8uO2eXI/C/fzsvd2uluKVd6lx0PnAZi82220JdSM0H7J1xZvv84NL7y5vDZcg3u27D5eNqPfF9Nw+qAmCdPs2IXafVoRp2hi13KkZfI47V9GG1xeFvOII4uAUtn5ZJkj4/7Bfn7Be3u9K5Jpd9XAiNmnu8dtcYsBwXUv1Yx5ZPm+XD5uHNLP+idStTu9S55PzKJbf8OISuo8sWXGIB9Ll2GTKPXEa07ENbXrH7ACPo+DTzfdNS1TOsYCn12KjsdsFyGVRxz099P83+CbDjYNRvDaAS7jCobrD4UY6InAskzwNqwtCdKXbI0voPrvFnEOSCi2MwVjL2Qx3bflwE/1RhUiF4OiWghGlvbgpX/zw8nUvOuy5Nlz6babxeDdvHmWgAeZgP415EbRLLMwvXp+PONSZE9DNQrnZne14VpuelFXU8Xrv8MN0dEssQhxhjsgirers7VPb71/WEiQHrSWqrKqsmr8kyaqC2qVXTAcs2xuT/TKrzgEqZJmcxuaS11+P7DRfhP1nyRlDzKikN0zS1S51LzgcuZUbTXmPbANqTac8QTJqWxwqZhqTLObhETUq3l1XhegwF8A4F8CnUoRRZ4lpwyS3DLaoq3+9GHeqUXONkrJaWL8swtnl4ikpjuOy2ceU+AAM+1oOnWaLUeYwLl35MfZLvry4x6o5nIWOKM87ZOUqxQ/TPdda58PzCpcSHU2a4f2y6HN1vjNQ14TLyTFHEtOwDl+2DS6duQxSCsXi8OO2aPXdYGCYqm67rAmaAtV6ndnnY+zPabfI4ZXLuykMMO46XT91Ow+XjahqnkTyHve3SmoS0idfi3GKNaJc6XyPvuzQlg8tJhY4i7YN7dbm9GyeKcWbApVvEFm08OM2XXew7SFyhWFpNV4/N6RLogiyNLHM+l4zXP8qgyrEjASTJJa7Qpl3xk5QZcxNwDnzSeHmaLwdHlxlcNvKOy6x2aXDOtEudr5dfuvQsI6YOZsMlyUBj3kAtasHlZHo3dHDnd3RJUx5c8shHfVt+b7jEPpt/MulZ9DOilVKcG/MqwKYF3DfSZFtvYccYuKR/1QB52+WQXMpPz5eGni91vmR+5dKPLCOdjG8bN5gDtDPWVWJHlmVEQFZB7XWHWv/k0qHNseTSTgW2xn5ruMRcmBWSc7coCqG4FRnzGCdj9y157tD+2T7dnMa2AZbHRGn66rLVuL+UBjvlXZcqimpeb/8bD9qlzkXnly49y7JjWp45u3SAJ5hALGfMMsMK0yLaJHBJu8oxma6TRAguY9o1Ozi7dDCRZnOlOCsK1xTc8gwZ06aFEVDjbMCrd8WL2LfMk50oDc8uW6f50vi0Szy0y3/Zu5vd1okwDMBcB/fhBfJo/uRYzGI2jpRFmxS1dhXLysI7aNTIXZT8VKRQiaoblt2hSkVdVarEhXAzvN/YDSk01NACRpqXk5Sek5x0cR599sw3Mz7/w+x2KaN+wnmkN+u4wpAebpoRYrkOlC7s/SVcuhUicInby9sihbpydntG3XmbjC+v0jwSzqUIjOW0/TqN2dYuD/FmzHUen09OSiUFU+r395fh1nVsxrbyJ/eXf1Iv/XlePp3On7qMFI9GBQ2bhhuXMY3O1GJpx7yLhyHVS9rfzplVOc2g5GjCW227xBxIWUaB4MwIFZg0BczINS3AJVZgAWd8QLv1zHI+V8+isi2X2+M+beplSvyUd+nzv8xOl1LqfpTAZX57dryZiQwPaXQmLznnVaXsDH8Gl3GvcXlzBX1irmjecdsltSOUfUabArmz9oxN4LIsaPKzcRnDJV7lXD4ne71ekqwWLv9wf5ll/jrW5/+RP6+XCdejHGswV1Qwe26fuf3V5SLPGVyaxJ4QP7ikkgmXqx9ANlKKUyXc7polTyVLyCVEW1PpBGGFG/hBqF5iUBctsicl1Tj8xzm+Qm7jsrd/uOP+Uj67RLauYwtNwQv0bzFGV5VSyrv06Xh2uUQ0y+hfdVrvVgkagImllBid4XkphBFU8O7GPVo/CZQDtyQk1xHjLLdwGfY2LnHxe1skCk6k4Nwdb6uyrO6fqy9ke8QTw7lFDkub+csULseoxOQS3XyHjcutkMuycfncHhsen9ufT+igorwoy3wTdMvmo5Gcc8GyN2F6lz7t82+6JBiaXKKqOZdoH6fFxcfntzmt5JJRiWEfuMRFppvswM6xy8JEmumcv+zCQzdCApdRX0shmEuA5LfksudcHpDLy/ujvK93uMT97Z+6/KyJ21V2Ppm+lqyquBKyrctPP/HxaZH/xOUUcx7O5b5zSWuRS2HI5eTpgepl7XIf5S5NRcRecYkBoUKpKGLmpcvzjUuwpNWdNi/f7RK+z87PXsvF1XclV9IE3qVPp9PG5RzTGaFzOajbchZFCQ9CF7Tvc1i7BC23qQfD+8oT/gSXe1su73mZwGVk5LZLuN52OXx84h/hMsZuJdev5QFtgpbbNPMufTqd3S6V46G1XR+hRbZ2CX69HlW1QsNlSrtK9kKQhMs9zKCcT9dWaMZL2q/rhcvLe+tcZn90uV+7jOFy/HA+Pyne6xIwUcN7f4jbBnpaMGZTq7xLny7nT1xy5WqmLajZDtMQYeNyfHo+L+BBFjiZBGpoDoNsUXPs2hjncnL+0iX680rFdRS8dKnuMf0Jd+SS/obTi8m7XSLuTBN6QlftJvTdNVz2I51a7l36dDm7XXLOnUudnqB7gBrLqSxSLaJ/3SWTEhe4D1DzGWYv69HUxVEBd6i09I798LPfuZTaHaf3wuXjR7vc3tfZPTZxt8bTvN+vzNy79Ol0/swlAhzMzlIMu4Z7qDjOZQ+t6+Qypa1CUEObM7pg5sfCCiEYXN6enf7OZUou+0zybZe0uLNXu+x9qMvX0rgsq0pw79Kn03nLJaJpdfIKLgfk8jO4vLvi5NItJtkPG5fDB3S3skBwvsNl8EeX0rkMyWX47DI173FZf+jBa4mdy3WqteH+/tKn03nDJSce6HalFtna5R4Oer58ykqWrtcY9hk09fKzcHh5vzxhStCbiulrLkUUwaX6g8vY7ei117i04h0uQbxu+dmkt0mMK3ByaZY6SbxLny5nt0tFNJVyqzrmF6fj0C2BdJu44pQfcnl0/7iiJc1NvbxbrKleAqZ9tV4KEfzepXAuD5p6eVi7NO92eRgOXo1zaQOtA9/v49PpOJdvROdFvfDjED6AaEjLLNM0n5+fAo1rbe2F+9cgU/CMGg7I5cPwpcuyhKCEmyDYcmmb+0tU4h7cD+GyeMf8ZYjU3fWvu9x347H9SEjhXfp0OW1cBuXJ4odrAkjFzW1LsCgK0nAc0+QluURz7Fk2S+eZhssUu+i95lImykTRlktGm3rRkUKH4bPLvB+92+X2/GX4W/AzOpeJkNK79OlyWrlk9Xl7aB04IJchVjnzoixp5x93detcPj7ZXCq4NK+4vNy41Nsug8blYQ3HuSz/tsu9xiV+wNX16rVQv0/ZZ9K79Ol2WrqkRli4PGhcPjxN4PIKo7Qbl6ubqwIuWe2S5i9fumRwKZLEaLZxqfMMLkPn0tU16lg4KYP31stw5/kkN/e365IxYfx1rE+n08alsnQjCIPuMALnhzoLEuwhErutfSCrRweTlAoutYDLBP0+h9su7zlcskQJs+1y8kQu457bSMR5l+9xCZjuaXWDw0nu8UDwXOeefudHkQZZYo3xLn26nJYuqRO2dklFifYsKHK6Vt1venV68SlmL7VrqhVS5gnAHb5cT1IKwZIETy9dDmuXhwPgw8vgkr3DZbPO62K+PuLcpva3HOHXXJmlCTJltfYufbqcVi5FuTnQvefWa7gdJbEs03UVDODSNccWQVa7NG6d12dbLtFzUBoTZYkUarPHjp25Ntr4oHZ5cICymr5v/rJ2eXxhZ7O8SZEXBR70f0VKu/Epzvy6aJ9up51LTTeYcUgrSurd0x/u7QkdSAtNcFlvNWBtkAXQxODSoqP9YMslbZQHl0ki5ZbLkyka+ZzLnnPp9iuw9r0usY+InBVLY9J0mW7VzLLUziVjkXfp0+m0cql0XhK0GPURhg7oX/7kBLulwyXaTpvm2NSogCmIkkFevHTpFliZqh+xFy4LKrkDuEScS5xuUrKPcDlfp1IKIV+EM22QIMuSwLv06XLauYxGOXbYip1LJBygiaC8f2xcgsw+LlTzzxWrXWZ0P7racnmA1xdp1e/DZfCKy7B26caOmBQf4dKN7QiEb0UFgUayJPEufbqcNi45r0Y5TmUnl5jTAMsBlpRgKmTsXA4AZ/h4L8lloIKM8aw8IcZbLvF6uIwSLrlSGbwAnk5TjCY5l8h+XXQxdiQ/oF6qk1KXUaRfBC6zTOtSB96lT7fTql7yqion54/D3sCttCSXd1eodeO4hyOFEOoAWhdBxRTnLGIspeO8NhMlNNHvzrZMlDQ6AQojJec6PUJ73z4VSgI/oHacW+qw/ZsuNxviOZdW67q1aMOSMa4UfWsZU2+79Oe4+7TOf+NSGZNK3E6iOu7Tuo8BHdyFYZ/xwQFc7tUHk6xTgYI4l6zfh8v52ekw3HKJejrrJ5M5uVRmSS7xInQrOJc92oOWDpsWJ/jTv+2ymSoJt8/z2nGal3fp0+W0cpkYU0DIinbmIIY9OgaTugrIJUGl/WGdSzWXAVxKIrftEq+fzEZaKWEDjmHSSmVZscZw7Hjw7NJhl0XCpfgol1S+/4gyo3iXPl1Ouz481MuinsE8hEsgGR7f/PCwIpbkcg8Tj/O1bFxGUWDWR2Abbh0D5o44GOnJRBgDlpARpWt0w8fO5QFchj26GC4/yOXs2aX6Q7n09dKn82nnUoj65LwQ2aPqtr96eDzGZWzTY4MJjiO4jCKlnEvhNmnfGpAN0YmQzr5aqgk3pnI3e2WRwm7jsgd8biMSloiPu46lAxX+EO/Sp/tp45IxmsGkQZoYLPdolGaALVrH8bPLA3eItJEaImXQj4RYrlFef3N5eEhLRWZfVXzOpRGBLrUucOgQVlvDZUgsBzE1BRVRJj/G5a5z9lgd79Kny2njUmulgpzWYB4cAGZILun8LULgHvEpJgyXxrK+BhMdSVEVNKazcUlbRKJnIK8CpTJuGdOfV822tJSDz8DTnXhbZIH8mOvYHS6Zd+nzP0gbl5FWc1NS0xwqJLmM4bI5EZPSowGbfGlk7TLScInyerdqVDYjshfTn9eCmm1sEkXV+ucp7X5ZZ49cXtMJ8Rn7KJeMwjnz95c+/7+0cVlV87kuc+wWSxMj9XY+e8CEhyuGPToZIae5j36FJ22krMrix7Pjmi3iplIun77+eZ1q0Oj30/XPX+PuEm3w+AspA8ySYPayTPTyA1yeW3wSUrwIfsMijDHv0qfbaeuSjdBbhxtMUoR10DAJmngQS3cwyahayoRcSrgUUZ8Yx+HGJQrm9d39dD2bneTIbD29vzkeYwN3pFe7vETRZcwsP+L+Us4K+1q4EIziXfp0Ou1cqnnQH+EM6Gu4PAREcgmh5BLf0trLGVzyJKJ6WVWCXB4tsBk0gpe7ekkV82IxnR8h8+ni4vJ6SG0+zy73aTOvMmLGCLHr/Mu2Lq9/uPpxcXXV/Nr8R1ksphkT3qVPt9Nu3Med3Tyjf/3NJsxwubkA3cftpYVLWqhh6r50EUTl+uuzhzGBcwcDUQ5WDzdn5/cQ8nR297CC1HEc92I88LIVdb6PNE2Csr/gUgkpapef/Zad+4ggN1eT1LTpK2DepU/b/CcuQUQpvpwpbEJAYz3No3ZJc5l3dHtJLt08vntHxoojOmc6BNu4GdzBwufr08e7m5u7x9MVyJLLZll1CHGLYjSiS+A3XWYvXZr+712Gw/EQGQ9XeIw3GeLX8PT8dm0yv/7Sp9Np11cAcLJyi503Lj+DFRqVRT08pl6eqjKaXHLnEk/Wtb+GgzgGzoHrEwLM8coFIJtSijRHRc+LUSWlZfq9LpFwk94mwB+7065nS+bXk/h0Oi1cIlnG5edlQTeYzqV76oEbucTBJPOZrrQ2QSDts8ssSGdYcjJ0NmjdJiDHMWi6p/D5GrgHtm6HyrOvjzTK5Vz1++9zuTtun9vji9tZ6l36dDvtXEYRXI7o1JHxbxOXWDMJl4eDMfoBTshlwLiUwrkkmLTJwU0Nc9+pAkcHks6mJNquYsbxgMZq0chXjLScz5PoI1z2Xsm2S+Zd+nQ5rVyqKGI8qPL50+OYQNXp0bmXe2g3p36AqtKuj5aTSpfAzZXcXQ/Bzw27Os/OIupsU3aHuD39chBjCmVOd5ccLpN/xiXi66XP/yVtXAquo4xvenieYfYOXeGLqTm2jHSQZcJKAVIWpKhgJuV6+oTpkAEc1i7d6bAUKHEuY4I5RMvBtOiPSqsmcBn9U9exe96lz/8krVxK3c+46+H54Tps7i4RclkvrSxYxuCSWUmirHXXsipJ7JGDGQMWWNbvip3LuAcnqJdwOQZLyB71Szeg+2+4TPx4rE+n08Ylr13qEbZyPo5JV+OSdhWhtZcyjTIqkEwawWqXmXPJ16iYd8duXwPK1gCpu02N4/EYk5r306NC90v2eYa3sOAfcrnnFq54lz7/g7RxKWXUT1AvRzm//2YYNi5RLl3LANZe5mVUazIGMAPAxLtgM+E2Xc+vfni4HgMweoOQHs1kNtUWzerj68ezxXxtAmV59l3kWs0/1mW4Fbj017E+/4O0cUltdRHncJle/fL9GDWOHnE8RMbj4zNQoc4DVElhjCuVTlYWRZHQZc4W53fH9Yzl9sF36M/bH65O755+PMLsZ8A5V3iDZlK+dLmiboAxnmJUV+dS/c5lWWBpyjjekfHLUF+B9S59up02Lt0B7FwFuigWP1yebvLgnunm0AYIg0sELlErKSwKBIvKwk6vzm4eiWa8j9ABsTEyXB0/3pxdoZc911GgkBo0DzZJj348ezzdyuXF9Mhuu6RzcOku9u60TfAT3z3dHvEse5Old+nTPv+NS/ICDDotJlfnZy9z8bSYS7HrXeSMTnyfLp5+uHt8OD6+bnJ8+vB498PTYnq0Xi+rKHodCsRdXWx91tnF1cRytu1SGyGPJosn/OHbwWvw41qmA+/Sp8tp5RK8LMOzTa26/en2OZMp5ZbpXX/F88isLdZHkx8X9+c/3NzVufnh7Ol+8SMWl6yXy6qKdhSwqqq+u50ik4l7nt5mTPdfqGJCCCnn0+nXk9s3MkXwU8vlcmm8S58uBy51K5eWueeyLE9OsIQSj9msXnhc9j//PHgtWcAQd13bL/MTm9z++ONigRVXyI8/3fIjREoDfGyHy2iU5wU+b0bHc5X4UPdh+oUfGmxapmukaJF1sVxWgOld+nQ5bV26uIEdt+o/RSClZJzvPrWOsLHaV9Tv5zlYQBYlr5PKuRBmWend/X+lO4cLrx2VSF5YEQjxO5dLJE2XNn0jBc2R5iUcS+Fd+nQ5LV26J/oiNzFLra1S87mSUr2F2h0VEmidIm5Hj1LrUcXmSsil0X/W0iA5iFhdVVozJin4xK0XwKkxWvf7Wr4V2+9HkaVI7l36dDnt7i9R+xwwOKgh0FNVVUbINMX9mtgpsn4mWpKKlLAIpDWmmgO2drMUksJZEAWKb4BtvcDIuq5+F0XMvhHOlVIcX6z19dKn02ntMqtHcVSWJYCWZBmjGlVVS4r502qJL/P5nHNTIUutVKbc7wtuhRI2tWynS0OhepswLrm0VkfI9siQMYFKXNhbUSAtkAAF1rv06XL+Ur1EOFecc+jkLIn6LrsLXvMmoFY0/anBMkK2z9lilrTvCtPNy6GOSNL16hdf9KMtl8uUqaQOfyMo7hJlHtHepU+n09Zlw1JIIYx0l7GiLlFQs3vcZ1MvdamrETwAWBZphIwRuoat2GGTQEbMlixxRHGD2MeXbNulsSpR3Iq3Y5BAuzDv0qfLaT8e60JjoaaOUMrdIiLJn73TPXPGNCqV4PO5YlpbrgQSNMbwzU4e1prKLPF5kMwYFV6qvZuQdc65lHiJeCP6ufYmXHmXPl3On9TLnUUQ0ZpMNi5V9pZrGm9xpokVvhdwWcPMMjKwm0dA3AyFlpEpvPZ3LoOgqYWVw/1nYRuXyrv06XScSx/v0qdTcdexPt6lT6fiXXqXPt2Lv471Ln26l28//6IKfLxLn07Fu/QufX5t745VGgbCAI73OVxdfIiQ1uLQrnUueQTJVlw6Kd3O/Tbfq+9ipkT0ChEC9yG/H2Q5jnzTnxwZknicY3VJPN776JJ4dKlL4nGO1SXx6FKXxKNLXRKPLnVJPLrUJfHoUpfEo0tdEo8udUk8utQl8ehSl8SjS10Sjy51STy61CXx6NJ/3IlHl7okHl3qknh0qUvi0aUuiUeXuiQeXeqSeHSpS+LRpS6JR5e6JJ60O/l+bDHLjS6pJn2cnptR+eftTXl1xoaZbk+eOW55bbseurxbQQ1p1z2t+al5PBy6/Ha/ghrS+txuJvvR5rvS6owNRQvcorB3ae1722XPSypJl0uznexH2/Jq2X6y/bvbM+aOW97Qvi6pJu1yx2/H8zH3zrFUcj31FOSc+/5Vl9TxcP18oeA6XGn1j3wBFXkH96IPvqMAAAAASUVORK5CYII=">
				<?php exit(); ?>
			<?php endif; ?>\
			<section id="vote" style="background: <?= $parties[$json['vote_party']] ?>">
					<?php if ($json["vote_party"] == "dog"): ?>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
						<path d="M20.3 3l-.2.7-2.8 7.3H9.6c-.9 0-1.8.3-2.5.7L4.7 9.3l-1.4 1.4 2.4 2.4a4.6 4.6 0 0 0-.5 4l.8 2.1-1 3.6V28h2v-4.9l1-3.6v-.6L7 16.5l-.1-.9C7 14.2 8.2 13 9.6 13h8l3.4 3.3v-2.8l-1.8-1.8 2-5.5.3.3.3.5h1.9l3 2.3L26 11H22v5.9l-1 2.8V23l1 4v.9h2v-1.1l-1-4V20l1-2.8V13h3.1l2.2-4.3-.7-.5L24.3 5H23l-1-1.5-.2-.5zm-10 15L9 22.9V28h2v-4.9l.8-3.1h1a6 6 0 0 0 3.2 1h1v2.1l1 4v.9h2v-1.1l-1-4V19h-3c-1 0-2.4-.8-2.4-.8l-.3-.2z"/>
					</svg>
					<?php elseif ($json["vote_party"] == "elephant"): ?>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
							<path d="M18 5c-2.1 0-2.9.7-2.9.7-.3-.8-.8-1.7-2.6-1.7-1.2.1-2.5.5-2.5 3s2.3 6 4 6c.3 0 .3-.5.3-1.3 0 1.6-.1 1.9-1.1 1.9C11.6 13.5 9 10 9 7c0-.9.1-1.2.3-2H7c-3 0-5 2.5-5 5.5C2 13.9 4.2 14 4 21h4v-5h2v5h4s-.3-8 2-8c1.2 0 2.1 1.7 2 4 0 .5-.7 1-1 1v1c1.1 0 1.8-.1 3-1 0 0-.1.1 0 0 1.9-1.8 2-7 2-7 0-4.7-2.2-6-4-6zm1.5 6c-.3 0-.5-.2-.5-.5s.2-.5.5-.5.5.2.5.5-.2.5-.5.5z"/>
						</svg>
					<?php elseif ($json["vote_party"] == "dolphin"): ?>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
							<path d="M12.4 4a9 9 0 0 0-5.3 2c-.8.7 7.8 5 7 5.8-7.2 8.3-7 15.6-7.2 23.4 0 .4-.2.7-.5.9-.5.3-6.3 2.8-6.3 9 0 .5.3 1 .6 1 .6 0 2-2.2 3.2-2.6 1.2-.5 1.6-.1 2.7-.2s1.6-.6 2-1c.2.3 1.2.9 1.6.9l2.9-.2c1.2-.1 1.8.8 2 1 .7.4.8.4.9-.1.5-3.2-2-5.9-4.2-7.4-.4-.2-.3-.7.3-2a29.3 29.3 0 0 1 14.2-13.7c-.8.7-4.3 4.8-3.8 5 7.2 1.2 10.6-4 11-4.5.7-.7 1.5-1 2.4-1.2a70 70 0 0 1 10-.4c.8 0 3.2-.1 4-.8.5-.4 0-1-.6-1.3.4-.5.9-.9.3-1.7L47.4 14c.5-.7-1.4-8.5-12.3-9.2-8.8-.5-11.9 1.4-13.2 1.6l-1.2-.2c-.9-.3-4.4-2.4-8.3-2.2zM40 14a1 1 0 0 1 0 2 1 1 0 0 1 0-2zm1.6 6.8a41.7 41.7 0 0 0-6.4.5l-1 2.3c3.6.4 6-1.2 7.4-2.9z"/>
						</svg>
					<?php elseif ($json["vote_party"] == "lion"): ?>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
							<path d="M17.4 1C15 1 11.8 2 9 4.3c-2.8 2.3-5 6.1-5 11.6 0 1.7.5 3.9 1 5.8l1 3.5a19.9 19.9 0 0 0 11.6 21 1 1 0 0 0 1.4-.6 10.7 10.7 0 0 0 6 3.4h.4c.9-.3 3.4-1 5.6-3.4.1.3.3.5.6.7h.8s3.4-1.4 6.6-4.7c3-3.3 5.9-8.7 5-16.4a78.8 78.8 0 0 0 2-9.3c0-5.5-2.2-9.3-5-11.6C38.2 1.9 35 1 32.6 1 29 1 26 2.3 25 2.9 24 2.3 21 1 17.4 1zm0 2c3.6 0 6.7 1.7 7 1.8l.7.2.4-.1S28.8 3 32.6 3c1.8 0 4.7.8 7 2.8C42.2 7.8 44 11 44 16c0 1.2-.5 3.5-1 5.3l-1 3.5v.4a17.7 17.7 0 0 1-9 18.6v-1a1 1 0 0 0-2-.4c-2.2 4.4-5.8 4.7-6 4.7-.2 0-3.8-.3-6-4.7a1 1 0 0 0-2 .4v1c-1-.6-2.7-1.5-4.5-3.5-2.8-3-5.4-7.7-4.5-15v-.5l-1-3.4c-.5-2-1-4.2-1-5.4 0-5 2-8 4.3-10a12 12 0 0 1 7-2.9zM13 12c-1 0-1.7.5-2.3 1.3-.5.7-.7 1.6-.7 2.7 0 1.6.9 2.8 1.7 3.6.7.8 1.5 1.2 1.5 1.2.3 1.4 1 2.5 1.6 3.4 1 1.4 1.9 2.7 2.4 5l-.2 1.6c0 1.1.3 2.3 1.1 3.4.5.6 1.1 1 2 1.4A4 4 0 0 0 24 39h2a4 4 0 0 0 4-3.4c.8-.3 1.4-.8 1.9-1.4a5.5 5.5 0 0 0 .9-5c.5-2.3 1.4-3.6 2.4-5 .6-1 1.3-2 1.6-3.4 0 0 .8-.4 1.5-1.2.8-.8 1.7-2 1.7-3.6 0-1-.2-2-.8-2.8A2.8 2.8 0 0 0 37 12c-.8 0-1.2.4-1.7.6a4.1 4.1 0 0 1-2 .4 6 6 0 0 0-2.7-.6 13 13 0 0 0-5.6 1.4 13 13 0 0 0-5.6-1.4 6 6 0 0 0-2.6.6h-.2c-1 0-1.5-.2-2-.4-.4-.2-.8-.6-1.6-.6zm0 2l.8.4.8.3c-.8 1-1.4 2.1-1.5 3.5-.6-.7-1.1-1.4-1.1-2.2 0-.7.2-1.3.4-1.6.2-.3.4-.4.6-.4zm24 0c.2 0 .4 0 .6.4.2.3.4.9.4 1.6 0 .8-.5 1.5-1 2.2a6.7 6.7 0 0 0-1.6-3.5l.8-.3.8-.4zm-17.6.4a12 12 0 0 1 5 1.4l.7.2.4-.1.1-.1a12 12 0 0 1 5-1.4c2 0 4.4 1.8 4.4 4.7 0 1.7-.6 2.7-1.5 4l-2 3.3-.3-.6-2.1-3.8h.3c2.6 0 2.8-2.7 2.8-3.4a9.7 9.7 0 0 0-4.8 2.6 1 1 0 0 0-.3 1.2c.5 1.5 1.6 3 2.4 4.4.9 1.5 1.5 3 1.5 4 0 .7-.2 1.5-.7 2.1-.5.7-1.2 1.1-2.3 1.1-1.2 0-2.4-.8-2.4-.8a1 1 0 0 0-.6-.2 1 1 0 0 0-.5.1l-.1.1c-.1 0-1.2.8-2.4.8-1.1 0-1.8-.4-2.3-1-.5-.7-.7-1.5-.7-2.2 0-1 .6-2.5 1.5-4 .8-1.4 1.9-3 2.4-4.4a1 1 0 0 0-.2-1v-.1l-.1-.1c-.4-.4-2-2-4.8-2.6 0 .7.2 3.4 2.8 3.4h.3l-2.1 3.8-.4.6c-.6-1.3-1.3-2.4-1.9-3.3-.9-1.3-1.5-2.3-1.5-4 0-3 2.4-4.7 4.4-4.7zM25 29c-1.5 0-3 .2-3 .8v.8l1 .7s-.1 0 0 0c.2-.3.6-.4.8-.1.2.1.1.4 0 .7.5.4 1.4.7 1.2.7l1.3-.7c-.2-.2-.3-.6 0-.7.1-.3.5-.2.8 0v.1c.5-.3.9-.7.9-1v-.5c0-.5-1.5-.8-3-.8zm0 6.2c.6.3 1.5.7 2.8.8-.4.6-1 1-1.8 1h-2a2 2 0 0 1-1.8-1c1.3 0 2.2-.5 2.8-.8z"/>
						</svg>
					<?php elseif ($json["vote_party"] == "unknown"): ?>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
						  <path d="M19 3a10 10 0 0 0-7.7 16.3l-8 8 1.4 1.4 8-8A10 10 0 1 0 19 3zm0 2a8 8 0 1 1 0 16 8 8 0 1 1 0-16zm-3 5a1 1 0 0 0 0 2 1 1 0 0 0 0-2zm6 0a1 1 0 0 0 0 2 1 1 0 0 0 0-2zm-3 4c-2.2 0-3.7 1.2-3.7 1.2a1 1 0 0 0-.3 1c0 .4.3.7.7.8.3 0 .7 0 1-.2 0 0 .8-.8 2.3-.8 1.5 0 2.3.8 2.3.8a1 1 0 1 0 1.4-1.6S21.2 14 19 14z"/>
						</svg>
					<?php endif; ?>
				<?php if ($json["vote_party"] == "unknown"): ?>
					<span>Vote not registered yet</span>
				<?php else: ?>
					<span>You voted for <strong><?= $json["vote_party"] ?></strong></span>
				<?php endif; ?>
			</section>
			<section id="status" class="<?= $json["status"] == 4 ? 'unknown' : '' ?>">
				<div>
					<div class="<?= $json["status"] >= 0 ? 'completed' : 'waiting' ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
							<path d="M13 13h46a2 2 0 0 1 2 2v42a2 2 0 0 1-2 2H13a2 2 0 0 1-2-2V15c0-1.1.9-2 2-2z" fill="#85cbf8"/>
							<path d="M5 5h46a2 2 0 0 1 2 2v42a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7c0-1.1.9-2 2-2z" fill="#72caaf"/>
							<path d="M7 46h42a4 4 0 0 1 4 4c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1 4 4 0 0 1 4-4z" fill="#5dbc9d"/>
							<path d="M59 12h-5V7a3 3 0 0 0-3-3H5a3 3 0 0 0-3 3v42a3 3 0 0 0 3 3h5v5a3 3 0 0 0 3 3h46a3 3 0 0 0 3-3V15a3 3 0 0 0-3-3zM4 49V7c0-.6.4-1 1-1h46c.6 0 1 .4 1 1v42c0 .6-.4 1-1 1H5a1 1 0 0 1-1-1zm56 8c0 .6-.4 1-1 1H13a1 1 0 0 1-1-1v-5h39a3 3 0 0 0 3-3V14h5c.6 0 1 .4 1 1z" fill="#8d6c9f"/>
							<path d="M13 48c.6 0 1-.4 1-1v-2a1 1 0 0 0-2 0v2c0 .6.4 1 1 1zM8 44a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2c0-.6-.4-1-1-1zM28 44a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2c0-.6-.4-1-1-1zM33 44a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2c0-.6-.4-1-1-1zM38 44a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2c0-.6-.4-1-1-1zM42 47a1 1 0 0 0 2 0v-2a1 1 0 0 0-2 0zM48 48c.6 0 1-.4 1-1v-2a1 1 0 0 0-2 0v2c0 .6.4 1 1 1zM18 44a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2c0-.6-.4-1-1-1zM23 44a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2c0-.6-.4-1-1-1z" fill="#8d6c9f"/>
							<path d="M22.3 35.7c.4.4 1 .4 1.4 0l18-18c.3-.4.3-1 0-1.3a1 1 0 0 0-1.4-.1L23 33.6l-7.3-7.3a1 1 0 0 0-1.3 0 1 1 0 0 0-.1 1.4z" fill="#faefde"/>
						</svg>
						<span>Vote recorded</span>
					</div>
					<div class="<?= $json["status"] >= 1 ? 'completed' : 'waiting' ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
							<path d="M58 53H6a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3h52a3 3 0 0 1 3 3v38a3 3 0 0 1-3 3z" fill="#c2cde7"/>
							<path d="M58 31H6a3 3 0 0 0-3 3v16a3 3 0 0 0 3 3h52a3 3 0 0 0 3-3V34a3 3 0 0 0-3-3z" fill="#acb7d0"/>
							<path d="M11 53h6v4h-6zM47 53h6v4h-6z" fill="#9cb0c3"/>
							<path d="M53 47H11a2 2 0 0 1-2-2V17c0-1.1.9-2 2-2h42a2 2 0 0 1 2 2v28a2 2 0 0 1-2 2z" fill="#d3e0e8"/>
							<path d="M38.7 47H24l25.3-32H53l2 1v10.4zM17.7 47h-7L36 15h7z" fill="#dce9f0"/>
							<path d="M53 21h4v6h-4zM53 35h4v6h-4z" fill="#ffeb9b"/>
							<path d="M9 38.6L27.7 15H29L9 40.3z" fill="#dce9f0"/>
							<path d="M41 31a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" fill="#f5c872"/>
							<path d="M37 31a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" fill="#ffeb9b"/>
							<path d="M59 8H5a3 3 0 0 0-3 3v40a3 3 0 0 0 3 3h5v2c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2v-2h28v2c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2v-2h5a3 3 0 0 0 3-3V11a3 3 0 0 0-3-3zM16 56h-4v-2h4zm36 0h-4v-2h4zm8-5c0 .6-.4 1-1 1H5c-.6 0-1-.4-1-1V11c0-.6.4-1 1-1h54c.6 0 1 .4 1 1z" fill="#8d6c9f"/>
							<path d="M55 43c-.6 0-1 .4-1 1v1c0 .6-.4 1-1 1H11c-.6 0-1-.4-1-1V17c0-.6.4-1 1-1h42c.6 0 1 .4 1 1v1c0 .6.4 1 1 1s1-.4 1-1v-1a3 3 0 0 0-3-3H11a3 3 0 0 0-3 3v28a3 3 0 0 0 3 3h42a3 3 0 0 0 3-3v-1c0-.6-.4-1-1-1z" fill="#8d6c9f"/>
							<path d="M56 32v-2c0-.6-.4-1-1-1s-1 .4-1 1v2c0 .6.4 1 1 1s1-.4 1-1zM56 20h-2a2 2 0 0 0-2 2v4c0 1.1.9 2 2 2h2a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2zm0 6h-2v-4h2zM56 34h-2a2 2 0 0 0-2 2v4c0 1.1.9 2 2 2h2a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2zm0 6h-2v-4h2zM22 31a10 10 0 0 0 10 10 10 10 0 0 0 10-10 10 10 0 0 0-10-10 10 10 0 0 0-10 10zm18.2 0c0 4.5-3.7 8.2-8.2 8.2a8.2 8.2 0 0 1-8.2-8.2c0-4.5 3.7-8.2 8.2-8.2 4.5 0 8.2 3.7 8.2 8.2z" fill="#8d6c9f"/>
							<path d="M31 25v1.8c0 .6.4 1 1 1s1-.4 1-1V25c0-.6-.4-1-1-1s-1 .4-1 1zM12 23v16c0 .6.4 1 1 1s1-.4 1-1V23c0-.6-.4-1-1-1s-1 .4-1 1zM32 34c-.6 0-1 .4-1 1v1.8c0 .6.4 1 1 1s1-.4 1-1V35c0-.6-.4-1-1-1zM28.8 31c0-.6-.4-1-1-1H26c-.6 0-1 .4-1 1s.4 1 1 1h1.8c.6 0 1-.4 1-1zM35.2 31c0 .6.4 1 1 1H38c.6 0 1-.4 1-1s-.4-1-1-1h-1.8c-.6 0-1 .4-1 1zM28.5 26a1 1 0 0 0-1.4 0 1 1 0 0 0 0 1.4l1.3 1.3c.2.2.5.3.7.3.2 0 .5-.1.7-.3.4-.4.4-1 0-1.4zM35.5 35.8c.2.2.5.3.7.3.2 0 .5-.1.7-.3.4-.4.4-1 0-1.4l-1.3-1.3a1 1 0 0 0-1.4 0 1 1 0 0 0 0 1.4zM28.4 33.2l-1.3 1.3a1 1 0 0 0 0 1.4c.2.2.5.3.7.3.2 0 .5-.1.7-.3l1.3-1.3c.4-.4.4-1 0-1.4a1 1 0 0 0-1.4 0zM35 29c.3 0 .5-.1.7-.3l1.3-1.3c.4-.4.4-1 0-1.4a1 1 0 0 0-1.4 0l-1.3 1.3a1 1 0 0 0 0 1.4c.2.2.4.3.7.3z" fill="#8d6c9f"/>
						</svg>
						<span>Ballot card deposited</span>
					</div>
					<div class="<?= $json["status"] >= 2 ? 'completed' : 'waiting' ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
							<path d="M57 34c0 4-1 8-3 11.5l-12-7c.6-1.4 1-3 1-4.5a10 10 0 0 0-18.4-5.4l-12.2-7A24 24 0 0 1 57 34z" fill="#85cbf8"/>
							<path d="M43 33l-1-4.8L53.3 21s5.5 8.6 3.4 16.2-2.6 7.6-2.6 7.6L42 39.1z" fill="#72caaf"/>
							<path d="M54 45.5a24 24 0 1 1-41.6-23.9l12.2 7a10 10 0 0 0 17.3 9.9z" fill="#f6d397"/>
							<path d="M40.8 52.7a3.5 3.5 0 0 1-2.5 4.7 24 24 0 0 1-27.6-14.6 3.5 3.5 0 0 1 6.5-2.7 17 17 0 0 0 19.6 10.5c1.7-.4 3.4.5 4 2.1z" fill="#f5c872"/>
							<path d="M33 24V8a2 2 0 0 0-2.1-2A28 28 0 0 0 5 32c0 .5.1 1 .5 1.5.4.4 1 .6 1.5.6H23a10 10 0 0 1 10-10z" fill="#ed7899"/>
							<path d="M29 6.3v.5c0 2-1.3 3.7-3.2 4.3a24.2 24.2 0 0 0-11.4 7.7 4.5 4.5 0 0 1-5.6 1A28 28 0 0 1 29 6.3z" fill="#f283a5"/>
							<path d="M34 9V8a3 3 0 0 0-3.2-3A29.2 29.2 0 0 0 4 31.9 3 3 0 0 0 7 35H8A25 25 0 1 0 34 9zm22 25c0 3.4-.7 6.7-2.2 9.8l-10.6-5.6c1.2-3 1-6.4-.5-9.3l3.1-2c.5-.3.6-1 .3-1.4a1 1 0 0 0-1.4-.3l-3 2a11 11 0 0 0-7.7-4.1V11a23 23 0 0 1 22 23zm-23-9a9 9 0 1 1 0 18 9 9 0 0 1 0-18zM6.3 32.7a1 1 0 0 1-.2-.8A27.1 27.1 0 0 1 30.9 7.1h.1c.2 0 .5 0 .7.2.2.2.3.5.3.8V23l-1.2.2h-.2l-.8.2h-.2l-.7.3-.3.1-.7.4h-.2l-.7.5-.2.1-.7.6H26L24.5 27v.1l-.6.7-.1.2-.4.7-.1.2-.4.7v.3c-.2.2-.3.5-.3.7l-.1.2-.2.9v.2L22 33H7a1 1 0 0 1-.7-.3zM33 57a23 23 0 0 1-23-22h12a11 11 0 0 0 20.2 5l10.6 5.6A23 23 0 0 1 33 57z" fill="#8d6c9f"/>
							<path d="M48.3 25.1l.5-.1 1.8-1.1a1 1 0 0 0-1.1-1.7l-1.8 1.1a1 1 0 0 0 .5 1.9zM33 49a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2c0-.6-.4-1-1-1zM29.1 48.5a1 1 0 0 0-1.2.7l-.5 2c-.2.5.2 1 .7 1.2h.3a1 1 0 0 0 1-.8l.5-2a1 1 0 0 0-.8-1.1zM25.5 47a1 1 0 0 0-1.4.4l-1 1.7a1 1 0 0 0 1.8 1l1-1.7a1 1 0 0 0-.4-1.4zM21 44.6L19.6 46a1 1 0 0 0 1.4 1.4l1.4-1.4c.3-.4.2-1-.1-1.3a1 1 0 0 0-1.3 0zM20 41.5a1 1 0 0 0-1.4-.4l-1.7 1a1 1 0 0 0 1 1.8l1.7-1c.5-.3.7-1 .4-1.4zM14.4 19.9c.3 0 .5-.1.7-.4A23 23 0 0 1 26 12.1a1 1 0 0 0-.6-1.9 25 25 0 0 0-11.7 8 1 1 0 0 0 .8 1.7z" fill="#8d6c9f"/>
						</svg>
						<span>Vote counted in poll</span>
					</div>
					<div class="<?= $json["status"] >= 3 ? 'completed' : 'waiting' ?>">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
							<path d="M56.8 37.4a3 3 0 0 0-.6 2.4l1 6c0 .5-.2 1-.7 1.1l-5.7 2.2a3 3 0 0 0-1.7 1.7l-2.2 5.7a1 1 0 0 1-1.1.6l-6-.9c-.9-.1-1.8.1-2.5.7l-4.7 3.8a1 1 0 0 1-1.3 0l-4.7-3.8a3 3 0 0 0-2.4-.7l-6 1a1 1 0 0 1-1.1-.7l-2.2-5.7c-.3-.8-1-1.4-1.8-1.7l-5.6-2.2a1 1 0 0 1-.6-1.1l1-6a3 3 0 0 0-.7-2.4l-3.8-4.8a1 1 0 0 1 0-1.2l3.8-4.8a3 3 0 0 0 .6-2.4l-1-6c0-.5.2-1 .7-1l5.7-2.3c.8-.3 1.4-1 1.7-1.7l2.2-5.7a1 1 0 0 1 1.1-.6l6 1a3 3 0 0 0 2.5-.7l4.7-3.8a1 1 0 0 1 1.3 0l4.7 3.8a3 3 0 0 0 2.4.6l6-1c.5 0 1 .2 1.1.7l2.2 5.7a3 3 0 0 0 1.8 1.7l5.6 2.2c.5.2.7.7.7 1.1l-1 6a3 3 0 0 0 .7 2.5l3.8 4.7c.3.3.3.9 0 1.3z" fill="#72caaf"/>
							<path d="M51 32a19 19 0 1 1-38 0 19 19 0 0 1 38 0z" fill="#88d7b6"/>
							<path d="M32 49a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2c0-.6-.4-1-1-1zM32 15c.6 0 1-.4 1-1v-2a1 1 0 0 0-2 0v2c0 .6.4 1 1 1zM52 31h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2zM14 33a1 1 0 0 0 0-2h-2a1 1 0 0 0 0 2zM18.6 44L17 45.4a1 1 0 1 0 1.5 1.4l1.4-1.4a1 1 0 0 0-1.4-1.4zM44.7 20.3c.3 0 .5-.1.7-.3l1.5-1.4c.4-.4.4-1 0-1.4a1 1 0 0 0-1.5 0L44 18.5a1 1 0 0 0 .7 1.7zM45.4 44a1 1 0 1 0-1.4 1.4l1.4 1.5a1 1 0 1 0 1.4-1.5zM18.6 20a1 1 0 1 0 1.4-1.4L18.6 17a1 1 0 1 0-1.4 1.5zM37.6 49.1a1 1 0 0 0-1.7-.4 1 1 0 0 0-.2 1l.5 1.9a1 1 0 0 0 1.7.5c.3-.3.4-.7.2-1zM26.4 14.9a1 1 0 0 0 1.7.4c.2-.2.3-.6.2-1l-.5-1.9A1 1 0 0 0 26 12a1 1 0 0 0-.2 1zM48.4 27.6c.2.5.7.8 1.2.7l2-.5c.3 0 .6-.4.7-.7a1 1 0 0 0-1.3-1.2l-1.9.5a1 1 0 0 0-.7 1.2zM15.6 36.4a1 1 0 0 0-1.2-.7l-2 .5a1 1 0 0 0-.7.7c-.1.4 0 .7.3 1 .2.3.6.3 1 .2l1.9-.5c.5-.1.8-.7.7-1.2zM23.5 46.7a1 1 0 0 0-.8 0 1 1 0 0 0-.6.4l-1 1.7a1 1 0 0 0 1.8 1l1-1.7a1 1 0 0 0-.4-1.4zM40.5 17.3c.2.1.5.1.8 0 .2 0 .4-.2.6-.4l1-1.7a1 1 0 1 0-1.8-1l-1 1.7a1 1 0 0 0 .4 1.4zM49.8 41.1l-1.7-1a1 1 0 1 0-1 1.8l1.7 1h.5a1 1 0 0 0 .5-1.8zM14.2 22.9l1.7 1 .5.1a1 1 0 0 0 1-.7 1 1 0 0 0-.5-1.2l-1.7-1a1 1 0 1 0-1 1.8zM41.9 47a1 1 0 0 0-1.8 1l1 1.8c.2.3.5.6 1 .6.3 0 .6-.2.8-.6a1 1 0 0 0 0-1zM22.1 17a1 1 0 0 0 1.8-1l-1-1.8a1 1 0 1 0-1.7 1zM46.7 23.5c.2.3.5.5.9.5l.5-.1 1.7-1a1 1 0 0 0 0-1.8 1 1 0 0 0-1 0l-1.7 1a1 1 0 0 0-.4 1.4zM17.3 40.5a1 1 0 0 0-.6-.5 1 1 0 0 0-.8.1l-1.7 1a1 1 0 0 0 0 1.8c.3.2.7.2 1 0l1.7-1c.5-.3.7-1 .4-1.4zM27.6 48.4a1 1 0 0 0-1.2.7l-.5 2a1 1 0 1 0 1.9.5l.5-2a1 1 0 0 0-.7-1.2zM36.4 15.6c.5.1 1-.2 1.2-.7l.5-2a1 1 0 1 0-1.9-.5l-.5 2a1 1 0 0 0 .7 1.2zM51.6 36.2l-2-.5a1 1 0 0 0-.5 2l2 .4a1 1 0 1 0 .5-1.9zM12.4 27.8l2 .5c.5.1 1-.2 1.1-.7a1 1 0 0 0-.6-1.2l-2-.5a1 1 0 1 0-.5 1.9z" fill="#8d6c9f"/>
							<path d="M61.4 33.9a3 3 0 0 0 0-3.8l-3.7-4.6a1 1 0 0 1-.2-.8l1-5.8a3 3 0 0 0-2-3.3l-5.5-2a1 1 0 0 1-.6-.6l-2-5.5a3 3 0 0 0-3.4-2l-5.8 1a1 1 0 0 1-.8-.2L34 2.6a3 3 0 0 0-3.8 0l-4.6 3.7a1 1 0 0 1-.8.2l-5.8-1a3 3 0 0 0-3.3 2l-2 5.5a1 1 0 0 1-.6.6l-5.5 2a3 3 0 0 0-2 3.4l1 5.8c0 .3 0 .5-.2.8L2.6 30a3 3 0 0 0 0 3.8l3.7 4.6c.2.2.2.5.2.8l-1 5.8a3 3 0 0 0 2 3.3l5.5 2 .6.6 2 5.5a3 3 0 0 0 3.4 2l5.8-1c.3 0 .5 0 .8.2l4.5 3.7a3 3 0 0 0 3.8 0l4.6-3.7c.2-.2.5-.2.8-.2l5.8 1a3 3 0 0 0 3.3-2l2-5.5.6-.6 5.5-2a3 3 0 0 0 2-3.4l-1-5.8c0-.3 0-.5.2-.8zm-5.2 3.3a3 3 0 0 0-.7 2.4l1 5.8c0 .5-.2 1-.7 1l-5.5 2.2a3 3 0 0 0-1.7 1.7l-2.1 5.5a1 1 0 0 1-1.1.6l-5.8-.9a3 3 0 0 0-2.4.7l-4.6 3.7a1 1 0 0 1-1.2 0l-4.6-3.7a3 3 0 0 0-2.4-.7l-5.8 1a1 1 0 0 1-1-.7l-2.2-5.5a3 3 0 0 0-1.7-1.7l-5.5-2.1a1 1 0 0 1-.6-1.1l.9-5.8a3 3 0 0 0-.7-2.4l-3.7-4.6a1 1 0 0 1 0-1.2l3.7-4.6a3 3 0 0 0 .7-2.4l-1-5.8c0-.5.2-1 .7-1l5.5-2.2a3 3 0 0 0 1.7-1.7l2.1-5.5a1 1 0 0 1 1.1-.6l5.8.9a3 3 0 0 0 2.4-.7l4.6-3.7a1 1 0 0 1 1.2 0l4.6 3.7a3 3 0 0 0 2.4.7l5.8-1c.5 0 1 .2 1 .7l2.2 5.5a3 3 0 0 0 1.7 1.7l5.5 2.1c.5.2.7.6.6 1.1l-.9 5.8a3 3 0 0 0 .7 2.4l3.7 4.6c.3.3.3.9 0 1.2z" fill="#8d6c9f"/>
							<path d="M44.7 24.3a1 1 0 0 0-1.4 0L29 38.6l-7.3-7.3a1 1 0 0 0-1.3 0 1 1 0 0 0-.1 1.4l8 8c.4.4 1 .4 1.4 0l15-15a1 1 0 0 0 0-1.4z" fill="#f9efde"/>
						</svg>
						<span>Vote used in definitive result</span>
					</div>
				</div>
				<div>
					<p><?= $desc[$json["status"]] ?></p>
				</div>
			</section>
			<?php if ($json["status"] == 3): ?>
				<section id="stat">
					You helped <span style="color: <?= $parties[$json['vote_party']] ?>"><?= $json["vote_party"] ?></span> get <span style="color: <?= $parties[$json['vote_party']] ?>"><?= $json["proc"] ?>%</span> of the votes!
				</section>
			<?php endif; ?>
		</main>
	</body>
</html>
