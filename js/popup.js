function display(action, id)
{
if (action == 'show')
{
document.getElementById("popup"+id).style.display = "block";
document.getElementById("link"+id).href= "javascript:display('hide', "+id+")";
}
if (action == 'hide')
{
document.getElementById("popup"+id).style.display = "none";
document.getElementById("link"+id).href= "javascript:display('show', "+id+")";
}  
}
