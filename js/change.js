var arr=new Array();//定义一个数组保存图片
arr[1]="images/g1.png";//放图片地址
arr[2]="images/g2.png";
var num=0;
setInterval(turnpic,3000); //每隔3秒转换图片
 function turnpic()
 {
   var idsrc = document.getElementById("pic_change");
   var b_1 = document.getElementById("b1");
   var b_2 = document.getElementById("b2");
  do{
   if(num==arr.length-1)
	{
	    num=0;//重头再播放
		b_1.style.borderColor="#00C000";
		b_2.style.borderColor="#e3e3e3";
   }
    else if(num==arr.length-2)
	{
	    num+=1;
		b_1.style.borderColor="#e3e3e3";
		b_2.style.borderColor="#00C000";
   }
      else
	{
		num+=1;
		b_1.style.borderColor="#00C000";
		b_2.style.borderColor="#e3e3e3";
   } 
   idsrc.src=arr[num];
  }while( num == 0);
}


