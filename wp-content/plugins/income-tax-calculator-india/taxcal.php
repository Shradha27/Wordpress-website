<?php

$html='<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
<html>
<head >
	<title> Income Tax Calculator (India) </title>
</head> 
<body>

<style type="text/css">
#textcall td,#textcall table
{
border-top:none;
border:none;
}
</style>

<script type="text/javascript">

function clr()
{
document.getElementById("e").value="";
document.getElementById("n").value="";
}



function taxcheck()
{
clr();
var assyear = document.getElementById("assyear").value;
if(assyear=="1011")
{
tax_10_11();
}
if(assyear=="1112")
{
tax_11_12();
}
if(assyear=="1213")
{
tax_12_13();
}
if(assyear=="1314")
{
tax_13_14();
}
if(assyear=="1415")
{
tax_14_15();
}
if(assyear=="1516")
{
tax_15_16();
}
}



function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}




//tax calculation for 2010 to 2011	  

function tax_10_11()
{
 var pay = document.formy.pay.value;
 var radioButton = document.getElementsByName("gender");
 for (var x = 0; x < radioButton.length; x ++) 
 {
  if (radioButton[x].checked) 
  {
   if(radioButton[x].id=="gm")
   {
    var g = 0;
   }
   else if(radioButton[x].id=="gf1")
   {
    var g = 1;
   }
  }
 }
 var radioButton1 = document.getElementsByName("age");
 for (var x1 = 0; x1 < radioButton1.length; x1 ++)
 {
  if (radioButton1[x1].checked) 
  {
   if(radioButton1[x1].id=="l1")
   {
    var a = 0;
   }
   else if(radioButton1[x1].id=="g1" || radioButton1[x1].id=="g2")
   {
    var a = 1;
   }
  }
 }
 
 var result=0;
 
 if((a==0) && (g==0) && (pay<=160000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && (g==0) && ((pay>160000) && (pay<=300000)))
 {
  result = result+(((pay-160000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==0) && ((pay>300000) && (pay<=500000)))
 {
  result = 14000+(((pay-300000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==0) && ((pay>500000) ))
 {
  result = 54000+(((pay-500000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==0) && (g==1) && (pay<=190000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && (g==1) && ((pay>190000) && (pay<=300000)))
 {
  result = result+(((pay-190000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==1) && ((pay>300000) && (pay<=500000)))
 {
  result = 11000+(((pay-300000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==1) && ((pay>500000) ))
 {
  result = 51000+(((pay-500000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && (pay<=240000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==1) && ((pay>240000) && (pay<=300000)))
 {
  result = result+(((pay-240000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>300000) && (pay<=500000)))
 {
  result = 6000+(((pay-300000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>500000) ))
 {
  result = 46000+(((pay-500000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
}





//tax calculation for 2011 to 2012	  

function tax_11_12()
{
 var pay = document.formy.pay.value;
 var radioButton = document.getElementsByName("gender");
 for (var x = 0; x < radioButton.length; x ++) 
 {
  if (radioButton[x].checked) 
  {
   if(radioButton[x].id=="gm")
   {
    var g = 0;
   }
   else if(radioButton[x].id=="gf1")
   {
    var g = 1;
   }
  }
 }
 var radioButton1 = document.getElementsByName("age");
 for (var x1 = 0; x1 < radioButton1.length; x1 ++)
 {
  if (radioButton1[x1].checked) 
  {
   if(radioButton1[x1].id=="l1")
   {
    var a = 0;
   }
   else if(radioButton1[x1].id=="g1" || radioButton1[x1].id=="g2")
   {
    var a = 1;
   }
  }
 }
 
 var result=0;
 
 if((a==0) && (g==0) && (pay<=160000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && (g==0) && ((pay>160000) && (pay<=500000)))
 {
  result = result+(((pay-160000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==0) && ((pay>500000) && (pay<=800000)))
 {
  result = 34000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==0) && ((pay>800000) ))
 {
  result = 94000+(((pay-800000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==0) && (g==1) && (pay<=190000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && (g==1) && ((pay>190000) && (pay<=500000)))
 {
  result = result+(((pay-190000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==1) && ((pay>500000) && (pay<=800000)))
 {
  result = 31000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==1) && ((pay>800000) ))
 {
  result = 91000+(((pay-800000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && (pay<=240000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==1) && ((pay>240000) && (pay<=500000)))
 {
  result = result+(((pay-240000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>500000) && (pay<=800000)))
 {
  result = 26000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>800000) ))
 {
  result = 86000+(((pay-800000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
}


//tax calculation for 2012 to 2013	  

function tax_12_13()
{
 var pay = document.formy.pay.value;
 var radioButton = document.getElementsByName("gender");
 for (var x = 0; x < radioButton.length; x ++) 
 {
  if (radioButton[x].checked) 
  {
   if(radioButton[x].id=="gm")
   {
    var g = 0;
   }
   else if(radioButton[x].id=="gf1")
   {
    var g = 1;
   }
  }
 }
 var radioButton1 = document.getElementsByName("age");

 for (var x1 = 0; x1 < radioButton1.length; x1 ++) 
 {
  if (radioButton1[x1].checked) 
  {
   if(radioButton1[x1].id=="l1")
   {
    var a = 0;
   }
   else if(radioButton1[x1].id=="g1")
   {
    var a = 1;
   }
   else if(radioButton1[x1].id=="g2")
   {
    var a = 2;
   }
  }
 }
 var result=0;
 
 if((a==0) && (g==0) && (pay<=180000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && (g==0) && ((pay>180000) && (pay<=500000)))
 {
  result = result+(((pay-180000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==0) && ((pay>500000) && (pay<=800000)))
 {
  result = 32000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==0) && ((pay>800000) ))
 {
  result = 92000+(((pay-800000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==0) && (g==1) && (pay<=190000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && (g==1) && ((pay>190000) && (pay<=500000)))
 {
  result = result+(((pay-190000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==1) && ((pay>500000) && (pay<=800000)))
 {
  result = 31000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && (g==1) && ((pay>800000) ))
 {
  result = 91000+(((pay-800000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && (pay<=250000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==1) && ((pay>250000) && (pay<=500000)))
 {
  result = result+(((pay-250000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>500000) && (pay<=800000)))
 {
  result = 25000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>800000) ))
 {
  result = 85000+(((pay-800000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==2) && (pay<=500000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==2) && ((pay>500000) && (pay<=800000)))
 {
  result = result+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==2) && ((pay>800000) ))
 {
  result = 60000+(((pay-800000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
}


//tax calculation for 2013 to 2014	  

function tax_13_14()
{
 var pay = document.formy.pay.value;
 var radioButton = document.getElementsByName("gender");
 for (var x = 0; x < radioButton.length; x ++) 
 {
  if (radioButton[x].checked) 
  {
   if(radioButton[x].id=="gm")
   {
    var g = 0;
   }
   else if(radioButton[x].id=="gf1")
   {
    var g = 1;
   }
  }
 }
 var radioButton1 = document.getElementsByName("age");

 for (var x1 = 0; x1 < radioButton1.length; x1 ++) 
 {
  if (radioButton1[x1].checked) 
  {
   if(radioButton1[x1].id=="l1")
   {
    var a = 0;
   }
   else if(radioButton1[x1].id=="g1")
   {
    var a = 1;
   }
   else if(radioButton1[x1].id=="g2")
   {
    var a = 2;
   }
  }
 }
 var result=0;
 
 if((a==0) && (pay<=200000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && ((pay>200000) && (pay<=500000)))
 {
  result = result+(((pay-200000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && ((pay>500000) && (pay<=1000000)))
 {
  result = 30000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && ((pay>1000000) ))
 {
  result = 130000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==1) && (pay<=250000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==1) && ((pay>250000) && (pay<=500000)))
 {
  result = result+(((pay-250000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>500000) && (pay<=1000000)))
 {
  result = 25000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>1000000) ))
 {
  result = 125000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==2) && (pay<=500000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==2) && ((pay>500000) && (pay<=1000000)))
 {
  result = result+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==2) && ((pay>1000000) ))
 {
  result = 100000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
}


//tax calculation for 2014 to 2015	  

function tax_14_15()
{
 var pay = document.formy.pay.value;
 var radioButton = document.getElementsByName("gender");
 for (var x = 0; x < radioButton.length; x ++) 
 {
  if (radioButton[x].checked) 
  {
   if(radioButton[x].id=="gm")
   {
    var g = 0;
   }
   else if(radioButton[x].id=="gf1")
   {
    var g = 1;
   }
  }
 }
 var radioButton1 = document.getElementsByName("age");

 for (var x1 = 0; x1 < radioButton1.length; x1 ++) 
 {
  if (radioButton1[x1].checked) 
  {
   if(radioButton1[x1].id=="l1")
   {
    var a = 0;
   }
   else if(radioButton1[x1].id=="g1")
   {
    var a = 1;
   }
   else if(radioButton1[x1].id=="g2")
   {
    var a = 2;
   }
  }
 }
 var result=0;
 
 if((a==0) && (pay<=200000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && ((pay>200000) && (pay<=500000)))
 {
  result = result+(((pay-200000) * 10)/100) - 2000;
  if (result <= 0)
  result=0;
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && ((pay>500000) && (pay<=1000000)))
 {
  result = 30000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && ((pay>1000000) ))
 {
  result = 130000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==1) && (pay<=250000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==1) && ((pay>250000) && (pay<=500000)))
 {
  result = result+(((pay-250000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>500000) && (pay<=1000000)))
 {
  result = 25000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>1000000) ))
 {
  result = 125000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==2) && (pay<=500000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==2) && ((pay>500000) && (pay<=1000000)))
 {
  result = result+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==2) && ((pay>1000000) ))
 {
  result = 100000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
}



//tax calculation for 2015 to 2016	  

function tax_15_16()
{
 var pay = document.formy.pay.value;
 var radioButton = document.getElementsByName("gender");
 for (var x = 0; x < radioButton.length; x ++) 
 {
  if (radioButton[x].checked) 
  {
   if(radioButton[x].id=="gm")
   {
    var g = 0;
   }
   else if(radioButton[x].id=="gf1")
   {
    var g = 1;
   }
  }
 }
 var radioButton1 = document.getElementsByName("age");

 for (var x1 = 0; x1 < radioButton1.length; x1 ++) 
 {
  if (radioButton1[x1].checked) 
  {
   if(radioButton1[x1].id=="l1")
   {
    var a = 0;
   }
   else if(radioButton1[x1].id=="g1")
   {
    var a = 1;
   }
   else if(radioButton1[x1].id=="g2")
   {
    var a = 2;
   }
  }
 }
 var result=0;
 
 if((a==0) && (pay<=250000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==0) && ((pay>250000) && (pay<=500000)))
 {
  result = result+(((pay-250000) * 10)/100);

  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && ((pay>500000) && (pay<=1000000)))
 {
  result = 25000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==0) && ((pay>1000000) ))
 {
  result = 125000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==1) && (pay<=300000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==1) && ((pay>300000) && (pay<=500000)))
 {
  result = result+(((pay-300000) * 10)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>500000) && (pay<=1000000)))
 {
  result = 20000+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==1) && ((pay>1000000) ))
 {
  result = 120000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
 else if((a==2) && (pay<=500000))
 {
  document.formy.t.value = 0;
  document.formy.e.value = 0;
  document.formy.n.value = 0;
 } 
 else if((a==2) && ((pay>500000) && (pay<=1000000)))
 {
  result = result+(((pay-500000) * 20)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 } 
 else if((a==2) && ((pay>1000000) ))
 {
  result = 100000+(((pay-1000000) * 30)/100);
  document.formy.t.value = Math.round(result);
  document.formy.e.value = Math.round(document.formy.t.value*(3/100));
  document.formy.n.value = (eval(document.formy.e.value)+eval(document.formy.t.value));
 }
}

</script>



<div id="textcall">
 <form name=formy>
   <table align=center>
<tr>
  <td>Assessment year (Select 2015-16 for current financial year)
  <td><select name="select"  id="assyear"  onchange="taxcheck();">
    <option value="1011">2010-2011</option>
	<option value="1112">2011-2012</option>
	<option value="1213">2012-2013</option>
	<option value="1314">2013-2014</option>
	<option value="1415">2014-2015</option>
	<option value="1516">2015-2016</option>
  </select></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr><td>Net Annual Taxable Income in Rs.<td> <input name="pay" type="text" size="16" class="innerc resform" onKeyPress="return isNumberKey(event)" ></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Gender </td><td ><input type="radio" id="gm" value="M" name="gender"  onClick="taxcheck();"> Male <input type="radio" id="gf1" value="F" name="gender"  onClick="taxcheck();">Female </td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Age </td><td ><input type="radio" id="l1"  name="age" onClick="taxcheck();"> Less than 60 <br /><input type="radio" id="g1"  name="age"  onClick="taxcheck();">
  Greater than 60<br />
  <input type="radio" id="g2"  name="age"  onClick="taxcheck();">
  Greater than 80 </td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Income Tax in Rs.<td><input name="t" type="text" size="16" class="resform"  readonly></td></tr>
<tr><td>Educational Cess in Rs.<td><input name="e" type="text" size="16" class="resform" readonly id="e"></td></tr>
 <tr><td>Total Tax Liability in Rs.<td><input name="n" type="text" size="16" class="resform" readonly id="n"></td></tr>
</table>

</form>
</div>
</body>
</html>';
?>