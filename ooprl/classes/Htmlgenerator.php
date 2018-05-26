<?php
//background:#1F8DD6; some kind of blue
class Htmlgenerator {
    public function __invoke($items) {
        foreach($items as $item) {
            echo $item;
        }
    }
    function __construct() {
        echo "<html><head><title>User Login</title><style type='text/css'>
@text-width: 100px;
@num-width: 80px;

.table-row {
  display: flex;           display: -webkit-flex;
  flex-direction: row;     -webkit-flex-direction: row;
  flex-grow: 0;            -webkit-flex-grow: 0;
  flex-wrap: wrap;         -webkit-flex-wrap: wrap;
  width: 1350px;
  padding-left: 15px;
  padding-right: 15px;
  justify-content: flex-start;
}

.text1 {
  flex-grow: 1;            -webkit-flex-grow: 1;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  padding-right: 20px;
  text-align: left;
  flex: 1;
}

.text1 {
  width: @text-width;
}

.num {
  width: @num-width;
}

.table-row {
  border-bottom: 2px solid #e0e0e0;
  border-collapse: collapse;
  padding-top: 5px;
}

.table-row.header {
  background-color: #FFEEDB;
  font-weight: bold;
  padding-top: 8px;
  padding-bottom: 8px;
}

	body {
		background:#cccccc;
        font-size: 16px;
	}
	h1{
		text-align: center;
	}
    h3{
        text-align: center;
        background-color: #ffeedb;
    }
	label {
		padding: 5px;
                
	}
	.dark {
		padding: 15px;
		background: #35424a;
		color: #ffffff;
		margin-top:10px;
		margin-bottom: 10px;
		line-height: 1.6em;
	}
	.field {
		width: 60%;
		padding: 10px;
                
		}
	.text, .password {
		float: right;
	}
	.button_1 {
		float: right;
		height: 38px;
		background: green;
		border: 0;
		padding-left: 20px;
		padding-right: 20px;
		color: #ffffff;
		margin:-25px -11px;
	}
    .button_2 {
		float: right;
		height: 38px;
		background: #e8491d;
		border: 0;
		padding-left: 20px;
		padding-right: 20px;
		color: #ffffff;
		margin:-75px -11px;
	}            
    .button_3 {
        color:#fff;
        border-radius:3px;
        
        background: #e8491d;
        padding:4px;
        margin-top:40px;
        border:none;
        width:100px;
        height:30px;
        box-shadow:0 0 1px 1px #123456;
        font-size:16px;
        cursor:pointer
    }          
	</style></head><body>";
    }
    function __destruct() {
        echo "</body></html>";
    }
}