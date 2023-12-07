{
	// Place your snippets for php here. Each snippet is defined under a snippet name and has a prefix, body and 
	// description. The prefix is what is used to trigger the snippet and the body will be expanded and inserted. Possible variables are:
	// $1, $2 for tab stops, $0 for the final cursor position, and ${1:label}, ${2:another} for placeholders. Placeholders with the 
	// same ids are connected.
	// Example:
	// "Print to console": {
	// 	"prefix": "log",
	// 	"body": [
	// 		"console.log('$1');",
	// 		"$2"
	// 	],
	// 	"description": "Log output to console"
	// }
	"PHP Tag": {
		"prefix": "php",
		"body": "<?php $1 ?>"
	},
	"Enline Echo": {
		"prefix": "echo",
		"body": "<?= $$1; ?>"
	},
	"conn": {
		"prefix": "conn",
		"body": [
			"$$host = 'localhost';",
			"$$user = 'root';",
			"$$pass = '';",
			"$$db = '$1';",
			"$$conn = mysqli_connect($$host, $$user, $$pass, $$db);",
			"if (!$$conn){",
			"echo 'Koneksi Gagal :'. mysqli_connect_error($$conn);}"
		]
	},
	"cek": {
		"prefix": "cek",
		"body": [
			"$$conn = mysqli_connect($$host, $$user, $$pass, $$db);",
			"if (!$$conn){",
			"echo 'Koneksi Gagal :'. mysqli_connect_error($$conn);}"
		]
	},
	"scriptwindow": {
		"prefix": "window",
		"body": "echo \"<script>window.location = '$1'</script>\";"
	},
	"scriptalert": {
		"prefix": "alert",
		"body": "echo \"<script>alert('$1')</script>\";"
	}
}