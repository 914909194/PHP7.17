<style>
	body{
		background: skyblue;
	}
	li{
		list-style: none;
		color: red;
	}
</style>
<?php
	if(isset($_COOKIE['id'])){
		$uid=$_COOKIE['id'];
	}else{
		header('location:login.php');
	}


?>
<?php 
	include "conn.php";
	if(isset($_GET['bid'])){
		$bid=$_GET['bid'];
		$sql="update chen set hits=hits+1 where bid='$bid'";
		$query=mysqli_query($link,$sql);
		if($query){
			
			$sql="select * from chen where bid='$bid'";
			$query=mysqli_query($link,$sql);
			$arr=mysqli_fetch_array($query);
		}
	}


 ?>
 <h3>标题:<?php echo $arr['title'] ?></h3> 
 <li>时间：<?php echo $arr['time'] ?></li>
 <span>访问率:<?php echo $arr['hits']?></span>
 <hr />
 <p>内容:<br><?php echo $arr['content']?></p>
 <hr />
 <form action="all.php?bid=<?php echo $arr['bid'];  ?>" method="post">
 	<textarea name="plcon" cols="30" rows="10"></textarea><br>
 	<input type="submit" name='sub' value="评论">
 </form>
 <?php 
 	if(isset($_POST['sub'])){
 		$plcon=$_POST['plcon'];
 		$bid=$_GET['bid'];
 		$sql="insert into pinglun(pid,plname,plcon,pltime,blogplid) values(null,'$uid','$plcon',now(),'$bid')";
 		$query=mysqli_query($link,$sql);

 	}
  ?>
  <?php
  	$sql="select * from user,chen,pinglun where user.id=pinglun.plname and chen.bid=pinglun.blogplid and pinglun.blogplid='$bid'";
  	$query=mysqli_query($link,$sql);
  	 while($arr=mysqli_fetch_array($query)){
  	?>
  		<p><?php echo $arr['plcon'];?></p>
  		<span>评论时间：<?php echo $arr['pltime'];?></span>
  		<span>&nbsp评论者：<?php echo $arr['uname']?></span>
  		<hr>
	
  	<?php	
  	}


    ?>
