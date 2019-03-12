function Check()
{
	var a=document.getElementById("name"),
	b=document.getElementById("address"),
	c=document.getElementById("person"),
	d=document.getElementById("tel"),
	e=document.getElementById("id-date-picker-1"),
	i=document.getElementById("text"),
	j=document.getElementById("number"),
	k=document.getElementById("id-date-picker-2"),
	l=document.getElementById("id-date-picker-3");
	if(a.value==""){
	 alert("姓名不能为空！");
	 return false;
	}else if(b.value==""){
	 alert("地址不能为空！");
	 return false;
	}else if(c.value==""){
	 alert("联系人不能为空！");
	 return false;
	}else if(d.value==""){
	 alert("联系人电话不能为空！");
	 return false;
	}else if(e.value==""||k.value==""||l.value==""){
	 alert("日期不能为空！");
	 return false;
	}else if(i.value==""){
	 alert("活动简介不能为空！");
	 return false;
	}else if(j.value==""){
	 alert("人数限制不能为空！");
	 return false;
	}
return;
}

