@extends('bootstrap.default')

@section('page-content')

    <?php
    use App\Http\Controllers\Controller;
    // $instant  = new Controller();
    // echo $instant->renderValue();

    // $results = DB::select('select * from splmod_users where id < ?', [10]);
    // foreach($results AS $key => $value){
    //     print_r($value);
    //     echo "<br>";
    // }
      $component = Controller::getComponent('home');
    ?>



    <div class="content p-3 pt-0 bg-white">
      <h1><?php echo $component->name; ?></h1>
      
      



<style>
  *,*::before,*::after{
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}


html{
  font-size: 1.1rem;
  font-family: 'Segoe UI';


}


.toolbar{
  display:grid;
  grid-template-columns: repeat(auto-fit,minmax(20px,40px));
  background-color: dimgray;
  color: rgb(0, 0, 0);
  position: fixed;
  width: 100%;
  justify-content: center;
  align-items:center;
   /* box-shadow: 0px -7px 8px 7px black; */
}

.tool-button{
height: 39px;
background-color: transparent;
cursor: pointer;
  color: #ffff;
  border: 1px solid transparent;
  margin-right: -1px;
  padding: 6px;
  text-align: center;
  grid-gap: 1px;
  margin: 1px;
  transition: all .5s;
}
.tool-button:hover{
  box-shadow: none;
  background-color: #6b5e5e;
  border: 1px solid rgb(187, 90, 0);
  box-shadow: 1px 1px 4px rgb(201, 130, 0);
}

.colorPicker {
display: flex;
  flex-wrap: wrap;
  position: fixed;
  width: 100%;
  backdrop-filter: blur(5px);
  transition: all .5s;
  z-index: 1;
}
.colorInstance {
min-height: 32px;
min-width: 40px;
flex: 1 0 0%;
opacity: 0.8;
cursor: pointer;
}
.colorInstance:hover{
opacity: 1;
box-shadow: 0px 1px 7px black;
}

.center{
   display: flex;
   justify-content: center;
   flex-wrap: wrap;
}


.editor{
  
  width:100%;
  height: auto;
  padding: 1rem;
  overflow-y: auto;
}
.editor-header {
padding: 12px;
}
.nameEditor {
margin-top: 61px;

}
.nameEditor > .textinput {
font-size: 1.5rem;
border: none;
border-bottom: 1px solid white;
padding: 0px;
width: calc(100% - 50px);
}
.textinput {
border-bottom: 1px solid white !important;
transition: all .3s;
}
.textinput:hover {
border-bottom: 1px solid DarkMagenta !important;
}
.nameEditor > .textinput:focus-visible {
outline:  none;
border-bottom: 1px solid rgb(0, 174, 255);
}
.editor:focus-visible {
outline:  none;
}

.getcontent{
  white-space: pre;
  width: 100vw;
  background-color: rgb(255, 255, 255);
  overflow: auto;
  padding: 1rem;
  display: none;
  margin-top: 1rem;
  box-shadow: .1rem .1rem .5rem rgb(255, 255, 255);
  border: 1px solid rgb(0, 0, 0);
}



.btn{
    padding: .5rem;
    background-color: #7e1111;
    margin-right: 1rem;
    color: #fffffc;
    letter-spacing: .1rem;
    font-size: 1rem;
    border-radius: .2rem;
    cursor: pointer;
    outline: none;
    box-shadow: 0 .4rem .4rem black;
    transition: all .3s;
}

.btn:hover{
    background-color: #7e1111d0;
    box-shadow: 0 .1rem .1rem black;
}

ul {
margin-left: 12px;
padding-top: 3px;
padding-bottom: 3px;
}
ol {
margin-left: 12px;
padding-top: 3px;
padding-bottom: 3px;
}

.editor > div {
padding-top: 6px;
padding-bottom: 3px;
}
.editor > p:last-child, .editor > div:last-child {
min-height: 50vh;
width: 100%;
}
.editor > p {
padding-top: 6px;
padding-bottom: 3px;
}
.d-none {
display: none;
}
.codeSection {
background-color: #edebd8;
  padding: 6px;
  font-family: monospace;
  font-size: 1.1rem;
}
.DateSection {
display: flex;
justify-content: space-between;
width: 100%;
height: 1px;
padding-left: 24px;
padding-right: 24px;
}
.DateSec {
color: gray;
display: inline-block;
text-align: justify;
background-color: gray;
width: 50%;
font-size: 0.7rem;


}
.DateSec > span {
display: table;
margin-left: auto;
margin-right: auto;
background-color: white;
margin-top: -0.5rem;
padding-left: 1rem;
padding-right: 1rem;
}
.lup {
filter: invert(1);
background-repeat: no-repeat;
background-position: center;
}
.lup-underline{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNMywxM2wxMCwwbDAsMmwtMTAsMGwwLC0yWm04LC0xMmwyLDBsMCw2YzAsMi43NiAtMi4yNCw1IC01LDVjLTIuNzYsMCAtNSwtMi4yNCAtNSwtNWwwLC02bDIsMGwtMCw2Yy0wLDEuNjU2IDEuMzQ0LDMgMywzYzEuNjU2LDAgMywtMS4zNDQgMywtM2wwLC02WiIgLz4KPC9zdmc+Cg==");
}
.lup-bold{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBpZD0iYm9sZCIgZD0iTTksMWwtNiwwbC0wLDE0bDYsMGMyLjIwOCwwIDQsLTEuNzkyIDQsLTRjMCwtMS4xOTQgLTAuNTI0LC0yLjI2NyAtMS4zNTUsLTNjMC44MzEsLTAuNzMzIDEuMzU1LC0xLjgwNiAxLjM1NSwtM2MtMCwtMi4yMDggLTEuNzkyLC00IC00LC00Wm0tMSw4YzEuMTA0LC0wIDIsMC44OTYgMiwyYzAsMS4xMDQgLTAuODk2LDIgLTIsMmMtMCwwIC0yLDAgLTIsMGwtMCwtNGwyLC0wWm0wLC02YzEuMTA0LC0wIDIsMC44OTYgMiwyYzAsMS4xMDQgLTAuODk2LDIgLTIsMmMtMCwwIC0yLDAgLTIsMGwtMCwtNGwyLC0wWiIgLz4KPC9zdmc+Cg==");
}
.lup-bulletlist{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNNCwzdjJoMTJWM0g0eiBNMCw1aDJWM0gwVjV6IE00LDloMTJWN0g0Vjl6IE0wLDloMlY3SDBWOXogTTQsMTNoMTJ2LTJINFYxM3ogTTAsMTNoMnYtMkgwVjEzeiIgLz4KPC9zdmc+Cg==");
}
.lup-numlist{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBpZD0ibGlzdC1udW1iZXJlZCIgZD0iTTAsMTBsMCwtMWwyLDBjMC41NTIsMCAxLDAuNDQ4IDEsMWwwLDFjLTAsMC41NTIgLTAuNDQ4LDEgLTEsMWwtMC43NSwwYy0wLjA2NiwtMCAtMC4xMywwLjAyNiAtMC4xNzcsMC4wNzNjLTAuMDQ3LDAuMDQ3IC0wLjA3MywwLjExMSAtMC4wNzMsMC4xNzdjMCwwLjE1MyAwLDAuMzQ3IDAsMC41Yy0wLDAuMDY2IDAuMDI2LDAuMTMgMC4wNzMsMC4xNzdjMC4wNDcsMC4wNDcgMC4xMTEsMC4wNzMgMC4xNzcsMC4wNzNsMS43NSwwbDAsMWwtMiwwYy0wLjU1MiwtMCAtMSwtMC40NDggLTEsLTFsMCwtMWMwLC0wLjU1MiAwLjQ0OCwtMSAxLC0xbDAuNzUsLTBjMC4wNjYsMCAwLjEzLC0wLjAyNiAwLjE3NywtMC4wNzNjMC4wNDcsLTAuMDQ3IDAuMDczLC0wLjExMSAwLjA3MywtMC4xNzdjMCwtMC4xNTMgMCwtMC4zNDcgMCwtMC41YzAsLTAuMDY2IC0wLjAyNiwtMC4xMyAtMC4wNzMsLTAuMTc3Yy0wLjA0NywtMC4wNDcgLTAuMTExLC0wLjA3MyAtMC4xNzcsLTAuMDczbC0xLjc1LDBabTQsMWwxMiwwbDAsMmwtMTIsMGwwLC0yWm0wLC00bDEyLDBsMCwybC0xMiwwbDAsLTJabS0zLC0zLjc1YzAsLTAuMDY2IC0wLjAyNiwtMC4xMyAtMC4wNzMsLTAuMTc3Yy0wLjA0NywtMC4wNDcgLTAuMTExLC0wLjA3MyAtMC4xNzcsLTAuMDczbC0wLjc1LDBsMCwtMWwxLDBjMC41NTIsMCAxLDAuNDQ4IDEsMWMtMCwxLjE4NSAwLDQgMCw0bC0xLDBsMCwtMy43NVptMywtMC4yNWwxMiwwbDAsMmwtMTIsMGwwLC0yWiIgLz4KPC9zdmc+Cg==");
}
.lup-italic{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBpZD0iaXRhbGljIiBkPSJNOS40MzksM2wtNSwxMGwtMy40MzksMGwtMCwybDksMGwwLC0ybC0zLjQzOSwwbDUsLTEwbDMuNDM5LDBsMCwtMmwtOSwwbDAsMmwzLjQzOSwwWiIgLz4KPC9zdmc+Cg==");
}
.lup-link{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNNi43OTQsMTIuNzk0QzYuMzE2LDEzLjI2OSw1LjY4MSwxMy41MzEsNSwxMy41MzFzLTEuMzE2LTAuMjYyLTEuNzk0LTAuNzM4Yy0wLjk4Ny0wLjk4OC0wLjk4Ny0yLjU5NywwLTMuNTg0TDUuNSw2LjkxNiBMNC4wODQsNS41TDEuNzkxLDcuNzk0Yy0xLjc2NiwxLjc2OS0xLjc2Niw0LjY0NCwwLjAwMyw2LjQxM0MyLjY0NywxNS4wNjIsMy43ODQsMTUuNTMxLDUsMTUuNTMxczIuMzUzLTAuNDY5LDMuMjA2LTEuMzI1IGwyLjI5NC0yLjI5NEw5LjA4NCwxMC41TDYuNzk0LDEyLjc5NHogTTE0LjIwNiwxLjc5NEMxMy4zNTMsMC45MzgsMTIuMjE2LDAuNDY5LDExLDAuNDY5UzguNjQ3LDAuOTM4LDcuNzk0LDEuNzk0TDUuNSw0LjA4NCBMNi45MTYsNS41bDIuMjk0LTIuMjk0QzkuNjg0LDIuNzMxLDEwLjMxOSwyLjQ2OSwxMSwyLjQ2OXMxLjMxNiwwLjI2MywxLjc5NCwwLjczN2MwLjk4OCwwLjk4NywwLjk4OCwyLjU5NywwLDMuNTg0TDEwLjUsOS4wODQgbDEuNDE2LDEuNDE2bDIuMjk0LTIuMjk0QzE1Ljk3NSw2LjQzOCwxNS45NzUsMy41NjIsMTQuMjA2LDEuNzk0eiBNMTEuNzA2LDUuNzA2bC0xLjQxNi0xLjQxNmwtNiw2bDEuNDE2LDEuNDE2TDExLjcwNiw1LjcwNnoiIC8+Cjwvc3ZnPgo=");
}
.lup-cut{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cG9seWdvbiBwb2ludHM9IjEzLjcwNywzLjcwNyAxMi4yOTMsMi4yOTMgOCw2LjU4NiAzLjcwNywyLjI5MyAyLjI5MywzLjcwNyA2LjU4Niw4IDIuMjkzLDEyLjI5MyAzLjcwNywxMy43MDcgOCw5LjQxNCAgMTIuMjkzLDEzLjcwNyAxMy43MDcsMTIuMjkzIDkuNDE0LDgiIC8+Cjwvc3ZnPgo=");
}
.lup-file-image{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNMTEuNSw3QzEyLjMyOCw3LDEzLDYuMzI4LDEzLDUuNVMxMi4zMjgsNCwxMS41LDRTMTAsNC42NzIsMTAsNS41UzEwLjY3Miw3LDExLjUsN3ogTTEzLDhsLTQsMkw2LDVsLTMsNnYxaDEwVjh6IE0wLDF2MTQgaDE2VjFIMHogTTE0LDEzSDJWM2gxMlYxM3oiIC8+Cjwvc3ZnPgo=");
min-height: 30px;
}
.lup-undo{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNMTYsMTFjLTAsLTIuMjA5IC0xLjc5MSwtNCAtNCwtNGMtMy41NDgsMCAtOC4xNzIsMCAtOC4xNzIsMGwyLjU4NiwtMi41ODZsLTEuNDE0LC0xLjQxNGwtNSw1bDUsNWwxLjQxNCwtMS40MTRsLTIuNTg2LC0yLjU4Nmw4LjE3MiwwYzAuNTMsLTAgMS4wMzksMC4yMTEgMS40MTQsMC41ODZjMC4zNzUsMC4zNzUgMC41ODYsMC44ODQgMC41ODYsMS40MTRjMCwxLjM5MiAwLDMgMCwzbDIsMGwwLC0zWiIgLz4KPC9zdmc+Cg==");
}
.lup-redo{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjxzdmcgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDE2IDE2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KICA8cmVjdCB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIGlkPSJpY29uLWJvdW5kIiBmaWxsPSJub25lIiAvPg0KPHBhdGggZD0iTTAsMTFjMC0yLjIsMS44LTQsNC00YzMuNSwwLDguMiwwLDguMiwwTDkuNiw0LjRMMTEsM2w1LDVsLTUsNWwtMS40LTEuNEwxMi4yLDlINEMzLjUsOSwzLDkuMiwyLjYsOS42UzIsMTAuNSwyLDExYzAsMS40LDAsMywwLDNIMFYxMXoiLz4NCjwvc3ZnPg0K");
}
.lup-strike{
background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTQuNTEzIDUuMjU3YzAgLjI2Ni4wMjYuNTE0LjA3Ny43NDNoMi4zNmExLjgzNSAxLjgzNSAwIDAxLS4yMjQtLjI2NSAxLjE1NyAxLjE1NyAwIDAxLS4xNDItLjU4NWMwLS40MjQuMTY1LS43NTUuNDk2LS45OS4zMy0uMjQ4Ljc3My0uMzcyIDEuMzI3LS4zNzIuNDk2IDAgLjk0NC4wODggMS4zNDUuMjY1LjQwMS4xNzcuNzkuNDE5IDEuMTY4LjcyNmwxLjA0NS0xLjMxYTQuOTEgNC45MSAwIDAwLTEuNjExLTEuMDYyQTQuODQyIDQuODQyIDAgMDA4LjQwNyAyYy0uNTY2IDAtMS4wOTEuMDgzLTEuNTc1LjI0OGEzLjc0IDMuNzQgMCAwMC0xLjIyMS42OSAzLjMzNiAzLjMzNiAwIDAwLS44MTUgMS4wNDRjLS4xODguMzktLjI4My44MTQtLjI4MyAxLjI3NXpNOC4xNzcgMTRhNi4wMDQgNi4wMDQgMCAwMS0yLjI2NS0uNDQzQTUuOTEzIDUuOTEzIDAgMDE0IDEyLjMwMWwxLjIwNC0xLjM5OGMuNDEzLjM4OS44ODUuNzA4IDEuNDE1Ljk1NWEzLjg5NCAzLjg5NCAwIDAwMS41OTMuMzU0Yy42NjEgMCAxLjE2My0uMTM1IDEuNTA1LS40MDdhMS4zMSAxLjMxIDAgMDAuNTEzLTEuMDhjMC0uMjM1LS4wNDctLjQzNi0uMTQyLS42MDFhMS4xNTYgMS4xNTYgMCAwMC0uMzcxLS40MjUgMi41ODggMi41ODggMCAwMC0uNTY3LS4zNTQgMTAuMzYgMTAuMzYgMCAwMC0uNzA4LS4zMThMOC4zODIgOUgyVjdoMTJ2MmgtMi4wNDZjLjA4LjE0LjE0OC4yOTEuMjA1LjQ1MS4xMTguMzE5LjE3Ny42OS4xNzcgMS4xMTUgMCAuNDcyLS4wOTQuOTE1LS4yODMgMS4zMjhhMy4yMjcgMy4yMjcgMCAwMS0uODMyIDEuMDk3Yy0uMzU0LjMwNy0uNzkuNTU1LTEuMzEuNzQ0LS41MDcuMTc3LTEuMDg1LjI2NS0xLjczNC4yNjV6IiBmaWxsPSIjMDAwIi8+PC9zdmc+");
}
.lup-colorpic{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNOCwxM2MyLDAsNC40OTctMS41LDQtNEMxMSw5LDYsMTMsOCwxM3ogTTgsMGMwLDAtNyw1LTcsMTBjMCw0LDMuNjg4LDYsNyw2czctMiw3LTZDMTUsNSw4LDAsOCwweiBNMTIuNjA2LDExLjY4NyBjLTAuMjQ0LDAuNDU2LTAuNiwwLjg2Ni0xLjA2MiwxLjIwOWMtMC40NjYsMC4zNS0xLjAxOSwwLjYyMi0xLjY0MSwwLjgxNkM5LjI5NCwxMy45LDguNjM3LDE0LDgsMTRzLTEuMjk0LTAuMS0xLjkwMy0wLjI4OCBjLTAuNjIyLTAuMTkxLTEuMTc1LTAuNDY2LTEuNjQxLTAuODE2Yy0wLjQ2My0wLjM0Ny0wLjgxOS0wLjc1My0xLjA2Mi0xLjIwOUMzLjEzMSwxMS4xOTQsMywxMC42MjUsMywxMCBjMC0wLjc4OCwwLjI3OC0xLjY4NCwwLjgyNS0yLjY2OWMwLjQ5NC0wLjg5MSwxLjItMS44MzEsMi4wOTQtMi43OTRDNi42NTksMy43NDEsNy40MDYsMy4wNTYsOCwyLjU1MyBjMC41OTQsMC41MDMsMS4zNDEsMS4xODQsMi4wODQsMS45ODRjMC44OTQsMC45NjYsMS42LDEuOTA2LDIuMDk0LDIuNzk0QzEyLjcyMiw4LjMxNiwxMyw5LjIxMiwxMywxMCBDMTMsMTAuNjI1LDEyLjg2NiwxMS4xOTQsMTIuNjA2LDExLjY4N3oiIC8+Cjwvc3ZnPgo=");
}
.lup-square{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cmVjdCB4PSIyIiB5PSIyIiB3aWR0aD0iMTIiIGhlaWdodD0iMTIiIC8+Cjwvc3ZnPgo=");
}
.lup-pencil{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNMSwxMXY0aDRsNy03TDgsNEwxLDExeiBNMTEsMUw5LDNsNCw0bDItMkwxMSwxeiIgLz4KPC9zdmc+Cg==");
}
.lup-trash{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNMTEsNWgydjguNWMwLDAuODI1LTAuNjc1LDEuNS0xLjUsMS41aC03QzMuNjc1LDE1LDMsMTQuMzI1LDMsMTMuNVY1aDJ2OGgyVjVoMnY4aDJWNXogTTIsMmgxMnYySDJWMnogTTYsMGg0djFINlYweiIgLz4KPC9zdmc+Cg==");
}
.lup-selectall{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNNi45OTksMTZoMi4wMDJWMEg2Ljk5OVYxNnogTTUuNDE0LDUuNDE0TDQsNEwwLDhsNCw0bDEuNDE0LTEuNDE0TDMuODI4LDlINlY3SDMuODI4TDUuNDE0LDUuNDE0eiBNMTIsNGwtMS40MTQsMS40MTQgTDEyLjE3Miw3SDEwdjJoMi4xNzJsLTEuNTg2LDEuNTg2TDEyLDEybDQtNEwxMiw0eiIgLz4KPC9zdmc+Cg==");
}
.lup-jsleft{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNC4xLjEsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDE2IDE2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KICA8cmVjdCB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIGlkPSJpY29uLWJvdW5kIiBmaWxsPSJub25lIiAvPg0KPHJlY3QgaWQ9Imljb24tYm91bmQiIHN0eWxlPSJmaWxsOm5vbmU7IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiLz4NCjxwYXRoIGQ9Ik0wLDEwaDEyLjFWOEgwVjEweiBNMCwwdjJoMTZWMEgweiBNMCwxNGg4di0ySDBWMTR6IE0wLDZoMTZWNEgwVjZ6Ii8+DQo8L3N2Zz4NCg==");
}
.lup-jscenter{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNC4xLjEsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDE2IDE2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KICA8cmVjdCB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIGlkPSJpY29uLWJvdW5kIiBmaWxsPSJub25lIiAvPg0KPHJlY3QgaWQ9Imljb24tYm91bmQiIHN0eWxlPSJmaWxsOm5vbmU7IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiLz4NCjxwYXRoIGQ9Ik0xNCwxMEgyVjhIMTRWMTB6IE0xNiwwdjJIMFYwSDE2eiBNMTIsMTRINHYtMmg4VjE0eiBNMTYsNkgwVjRoMTZWNnoiLz4NCjwvc3ZnPg0K");
}
.lup-jsright{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNC4xLjEsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDE2IDE2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KICA8cmVjdCB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIGlkPSJpY29uLWJvdW5kIiBmaWxsPSJub25lIiAvPg0KPHJlY3QgaWQ9Imljb24tYm91bmQiIHN0eWxlPSJmaWxsOm5vbmU7IiB3aWR0aD0iMTYiIGhlaWdodD0iMTYiLz4NCjxwYXRoIGQ9Ik0xNiwxMEgzLjlWOEgxNlYxMHogTTE2LDB2MkgwVjBIMTZ6IE0xNiwxNEg4di0yaDhWMTR6IE0xNiw2SDBWNGgxNlY2eiIvPg0KPC9zdmc+DQo=");
}
.lup-code{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNMTIuMjk0LDMuMjk0bC0xLjQxNiwxLjQxNkwxMy41LDhsLTIuNjIyLDMuMjk0bDEuNDE2LDEuNDE2TDE2LDhMMTIuMjk0LDMuMjk0eiBNNS4xMjIsNC43MDZMMy43MDYsMy4yOTFMMCw4bDMuNzA2LDQuNzA2IGwxLjQxNi0xLjQxNkwyLjUsOEw1LjEyMiw0LjcwNnogTTYsMTNoMmwyLTEwSDhMNiwxM3oiIC8+Cjwvc3ZnPgo=");
}
.lup-text{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBpZD0iZXhwYW5kLWNvbGxhcHNlIiBkPSJNNC40MTQsMTUuNDE0TDgsMTEuODI4TDExLjU4NiwxNS40MTRMMTMsMTRMOCw5TDMsMTRMNC40MTQsMTUuNDE0Wk0xMS41ODYsMC41ODZMOCw0LjE3Mkw0LjQxNCwwLjU4NkwzLDJMOCw3TDEzLDJMMTEuNTg2LDAuNTg2WiIgc3R5bGU9ImZpbGwtcnVsZTpub256ZXJvOyIvPgo8L3N2Zz4K");
}
.lup-clear{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNMTIuMDQyLDBoLTh2Mmg4VjB6IE0xMC44NywxMS44MjhDMTAuMTE0LDEyLjU4NCw5LjExMSwxMyw4LjA0MiwxM3MtMi4wNzItMC40MTYtMi44MjgtMS4xNzJTNC4wNDIsMTAuMDY5LDQuMDQyLDkgczAuNDE2LTIuMDcyLDEuMTcyLTIuODI4UzYuOTczLDUsOC4wNDIsNXMyLjA3MiwwLjQxNiwyLjgyOCwxLjE3MkMxMS4zODMsNi42ODQsMTEuNzM5LDcuMzE2LDExLjkxNyw4aDIuMDQxIGMtMC40NzUtMi44MzgtMi45NDQtNS01LjkxNi01Yy0zLjMxMiwwLTYsMi42ODgtNiw2czIuNjg4LDYsNiw2YzIuOTcyLDAsNS40NDEtMi4xNjMsNS45MTYtNWgtMi4wNDEgQzExLjc0MiwxMC42ODQsMTEuMzgzLDExLjMxNiwxMC44NywxMS44Mjh6IiAvPgo8L3N2Zz4K");
}
.lup-plus{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cG9seWdvbiBwb2ludHM9IjE1LDcgOSw3IDksMSA3LDEgNyw3IDEsNyAxLDkgNyw5IDcsMTUgOSwxNSA5LDkgMTUsOSIgLz4KPC9zdmc+Cg==");
}
.lup-heading{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBpZD0iaGVhZGluZyIgZD0iTTExLDhsLTYsMGwwLC03bC0yLDBsMCwxNGwyLDBsMCwtNWw2LDBsMCw1bDIsMGwwLC0xNGwtMiwwbDAsN1oiIC8+Cjwvc3ZnPgo=");
}
.lup-flame{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNOS42NSw0LjA1QzkuOCw0LjIsOS45NSw0LjM1LDEwLjEsNC41YzAuOSwwLjk1LDEuNiwxLjksMi4xLDIuOGMwLjU1LDEsMC44NSwxLjksMC44NSwyLjY1YzAsMC42LTAuMTUsMS4yLTAuNCwxLjcgYy0wLjI1LDAuNDUtMC42LDAuODUtMS4wNSwxLjJjLTAuNDUsMC4zNS0xLDAuNi0xLjY1LDAuOEM5LjMsMTMuOSw4LjY1LDE0LDgsMTRzLTEuMy0wLjEtMS45LTAuM3MtMS4xNS0wLjQ1LTEuNjUtMC44IEM0LDEyLjU1LDMuNjUsMTIuMTUsMy40LDExLjdDMy4xNSwxMS4yLDMsMTAuNjUsMywxMGMwLTAuNiwwLjItMS4zLDAuNjUtMi4xQzMuNzUsNy43LDMuODUsNy41LDQsNy4zYzAuOCwwLjY1LDEuNTUsMC44LDIuMDUsMC44IEM2LjksOC4xLDcuNyw3LjcsOC4zNSw3YzAuNC0wLjUsMC43NS0xLjEsMS0xLjg1QzkuNDUsNC44LDkuNTUsNC40NSw5LjY1LDQuMDUgTTgsMGMwLDMuOS0wLjg1LDYuMS0xLjk1LDYuMUM1LjQ1LDYuMSw0LjcsNS40NSw0LDQgYy0xLjY1LDEuODUtMyw0LTMsNmMwLDQsMy43LDYsNyw2bDAsMGMzLjMsMCw3LTIsNy02QzE1LDUsOCwwLDgsMEw4LDB6IiAvPgo8L3N2Zz4K");
}
.lup-minus{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cG9seWdvbiBwb2ludHM9IjE1LDcgMSw3IDEsOSAxNSw5IiAvPgo8L3N2Zz4K");
}
.lup-paste{
background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTYgMTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CiAgPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBpZD0iaWNvbi1ib3VuZCIgZmlsbD0ibm9uZSIgLz4KICA8cGF0aCBkPSJNMTQuNzA2LDQuMjA2YzAuMTg4LDAuMTg4IDAuMjk0LDAuNDQ0IDAuMjk0LDAuNzFsMCwxMS4wODRsLTE0LDBsMCwtMTZsOS4wODcsMGMwLjI2NiwwIDAuNTE5LDAuMTA2IDAuNzA2LDAuMjkzbDMuOTEzLDMuOTEzWm0tMS43MDYsOS43OTRsMCwtOWwtMywwbDAsLTNsLTcsMGwwLDEybDEwLDBabS03LjU4NiwtMy41ODZsLTEuNDE0LC0xLjQxNGw0LC00bDQsNGwtMS40MTQsMS40MTRsLTEuNTg2LC0xLjU4NmwwLDQuMTcybC0yLDBsMCwtNC4xNzJsLTEuNTg2LDEuNTg2WiIgLz4KPC9zdmc+Cg==");
}
.lup-u{
background-image: url("data:image/svg+xml;base64,");
}
.nameButton {
width: 30px;
  font-size: inherit;
  background-repeat: no-repeat;
  background-size: 22px;
  border: none;
  cursor: pointer;
  background-color: transparent;
  opacity: 0.5;
  transition: all .5s;
}
.nameButton:hover {
opacity: 1;
}
.addInfo {
padding: 6px;

}
.addInfo * {
font-size: 1.2rem;
border: none;
min-width: 200px;
width: 100%;
margin-top: 12px;
transition: all .5s;
}
.addInfo > input:focus-visible {
outline:  none;
border-bottom: 1px solid rgb(0, 174, 255);
}

</style>

  <div class="toolbar">

    <!-- <input type ='button' class="tool-button lup lup-underline"  onclick="document.execCommand('insertHTML', false, '<table><tr><td>123</td></tr></table>');"/> -->
    <input type ='button' class="tool-button lup lup-heading"  onclick="document.execCommand('formatBlock', false, '<h3>');"/>
      
      
      <input  type ='button' class="tool-button lup lup-underline"  onclick="document.execCommand('underline', false, '');"/>
      <input type ='button' class="tool-button lup lup-italic" onclick="document.execCommand('italic', false, '');"/>
      <input type ='button' class="tool-button lup lup-bold" onclick="document.execCommand('bold', false, '');"/>
      <input type ='button' class="tool-button lup lup-strike" onclick="document.execCommand('strikeThrough',false,'')"/>
      <input type ='button' class="tool-button lup lup-clear" onclick="clearFormat();"/>
      
      <input type ='button' class="tool-button lup lup-colorpic" onclick="choosecolor()"/>
      <input type ='button' class="tool-button lup lup-pencil" onclick="changeColor()"/>
      <input type ='button' class="tool-button lup lup-flame" onclick="changeBacklight()"/>
      
      
      
      <input type ='button' class="tool-button lup lup-bulletlist"  onclick="document.execCommand('insertUnorderedList', false, '');"/>
      <input type ='button' class="tool-button lup lup-numlist"  onclick="document.execCommand('insertOrderedList', false, '');"/>
      
      <input type ='button' class="tool-button lup lup-jsleft" onclick="document.execCommand('justifyLeft',false,'')"/>
      <input type ='button' class="tool-button lup lup-jscenter" onclick="document.execCommand('justifyCenter',false,'')"/>
      <input type ='button' class="tool-button lup lup-jsright" onclick="document.execCommand('justifyRight',false,'')"/>
      <input type ='button' class="tool-button lup lup-undo" onclick="document.execCommand('undo',false,'')"/>
      <input type ='button' class="tool-button lup lup-redo" onclick="document.execCommand('redo',false,'')"/>


      <input type ='button' class="tool-button lup lup-minus" onclick="document.execCommand('insertHorizontalRule',false,'')"/>
      
      <!--         <input type ='button' class="tool-button lup lup-link" onclick="link()"/> -->
      <label for="file" class="tool-button lup lup-file-image"></label>
      <input class="tool-button lup lup-file-image" type="file" accept="image/*" id="file" style="display: none;" onchange="getImage()">
      
      
      <input type ='button' class="tool-button lup lup-trash" onclick="document.execCommand('delete',false,'')"/>
      
      
      <input type ='button' class="tool-button lup lup-selectall" onclick="document.execCommand('selectAll',false,'')"/>
      <!--       <input type ='button' class="tool-button lup lup-selectall" onclick="insertCodeSection();"/> -->
      <input type ='button' class="tool-button lup lup-cut" onclick="document.execCommand('cut',false,'')"/>
      <!-- <input type ='button' class="tool-button lup lup-paste" onclick="insertNotFormatted()"/> -->


<!--   
    <input type ='button' class="tool-button lup lup-clone" onclick="copy()"/> -->

    <!-- Jutify -->



<!--       <input type ='button' class="tool-button lup lup-code" onclick="showCode()"/>
    <input type ='button' class="tool-button lup lup-text" onclick="showText()"/> -->
  </div>

  <div class="colorPicker d-none" id="ColorPicker" onclick="function fnc(e){e.preventDefault();};">
<!--       <div class="colorInstance" data-color="deeppink" style="background-color: deeppink;"></div>
    <div class="colorInstance" data-color="gold" style="background-color: gold;"></div> -->
  </div>

  <div class="container">
    <div class="editor-header">
      <div  class="nameEditor">
        <input type="button" class="nameButton lup-plus" onclick="toggleAddInfo();"/>
        <input class="textinput" type="text" id="PageName" value="The Header" maxlength="126" onchange="window.external.notify('+PLUS:');">
      </div>
      <div class="addInfo d-none" id="addInfo">
    <!--     <label for="Tags">Tags: </label> -->
        <input placeholder="Tags (comma separated)" class="textinput" type="text" id="Tags" value="" maxlength="126" onchange="window.external.notify('+PLUS:');">
       <!--  <label for="Description">Description: </label> -->
        <input placeholder="Short description"  class="textinput" type="text" id="Description" value="" maxlength="126" onchange="window.external.notify('+PLUS:');">
      </div>
    </div>
    <div class="DateSection">
      <div class="DateSec"><span id="Datem">12/23/23</span></div><div class="DateSec"><span id="Datec">45/45/45</span></div>
    </div>
    <div class="editor" contenteditable="true" id="WebVisor" onkeyup="window.external.notify('+PLUS:');">
      <h1>Simple Html editor</h1>
      <p>Good to start</p>
    </div>
  </div>
  

  <div class="center">
    <section class="getcontent">
    </section>
  </div>



<script>
var colorChangeMode = 0;
var selectedColor = "";

  var btn = document.querySelector(".sai");
var getText = document.querySelector(".getText");
var content = document.querySelector(".getcontent");
var editorContent = document.querySelector(".editor");

function toggleAddInfo(){
var addb = document.querySelector("#addInfo");
addb.classList.toggle("d-none");
}

function clearFormat(e){

const selection = window.getSelection();
if (!selection.isCollapsed) {
  if (selection.anchorNode.parentNode.tagName === 'FONT'
  || selection.anchorNode.parentNode.tagName === 'SPAN'
  || selection.anchorNode.parentNode.tagName === 'B'
  || selection.anchorNode.parentNode.tagName === 'U'
  || selection.anchorNode.parentNode.tagName === 'U'
  || selection.anchorNode.parentNode.tagName === 'I'
  || selection.anchorNode.parentNode.tagName === 'HREF'
  || selection.anchorNode.parentNode.tagName === 'STRIKE'
  || selection.anchorNode.parentNode.tagName === 'CODE'
  || selection.anchorNode.parentNode.tagName === 'H3'
  || selection.anchorNode.parentNode.tagName === 'H1'

  ){
    selection.anchorNode.parentNode.replaceWith(selection.anchorNode);

    e.preventDefault();
  }
}
}


// Handle the `paste` event
editorContent.addEventListener('paste', function (e) {
  // Prevent the default action
  e.preventDefault();

  // Get the copied text from the clipboard
  const text = e.clipboardData
      ? (e.originalEvent || e).clipboardData.getData('text/plain')
      : // For IE
      window.clipboardData
      ? window.clipboardData.getData('Text')
      : '';

  if (document.queryCommandSupported('insertText')) {
      document.execCommand('insertText', false, text);
  } else {
      // Insert text at the current position of caret
      const range = document.getSelection().getRangeAt(0);
      range.deleteContents();

      const textNode = document.createTextNode(text);
      range.insertNode(textNode);
      range.selectNodeContents(textNode);
      range.collapse(false);

      const selection = window.getSelection();
      selection.removeAllRanges();
      selection.addRange(range);
  }
});


function insertCodeSection(){
  document.execCommand('insertHTML', false, '<div class="codeSection">CodeHere</div>'); 
}

function showCode() {
var s = editorContent.innerHTML;
content.style.display = "block";
content.textContent = s;
};

function showText() {
const old = editorContent.textContent;
content.style.display = "block";
content.textContent = old;
};

function link() {
var url = prompt("Enter the URL");
document.execCommand("createLink", false, url);
}

function copy() {
document.execCommand("copy", false, "");
}

function changeColor() {
if (selectedColor != ""){
  document.execCommand("foreColor", false, selectedColor);
}
}
function changeBacklight() {
if (selectedColor != ""){
  document.execCommand("hiliteColor", false, selectedColor);
}
}

function getImage() {
var file = document.querySelector("input[type=file]").files[0];

var reader = new FileReader();

let dataURI;

reader.addEventListener(
  "load",
  function() {
    dataURI = reader.result;

    const img = document.createElement("img");
    img.src = dataURI;
    editorContent.appendChild(img);
  },
  false
);

if (file) {
  console.log("s");
  reader.readAsDataURL(file);
}
}

function printMe() {
if (confirm("Check your Content before print")) {
  const body = document.body;
  let s = body.innerHTML;
  body.textContent = editorContent.innerHTML;

  document.execCommandShowHelp;
  body.style.whiteSpace = "pre";
  window.print();
  location.reload();
}
}

function choosecolor(){
var colopic = document.querySelector("#ColorPicker");
colopic.classList.toggle("d-none");
}

var colorArray = [
"White",
"Aqua",
"Beige",
"BlanchedAlmond",
"Aquamarine",
"CadetBlue",
"Cyan",
"DarkTurquoise",
"DeepSkyBlue",
"Gainsboro",
"LightGrey",
"MediumSpringGreen",
"MediumAquaMarine",
"MediumTurquoise",
"PaleGreen",
"Pink",
"PaleGoldenRod",
"PowderBlue",
"SkyBlue",
"SpringGreen",
"Yellow",
"Violet",
"Tomato",
"Teal",
"SteelBlue",
"Turquoise",
"SlateGrey",
"Sienna",
"SeaGreen",
"SandyBrown",
"RoyalBlue",
"Red",
"Purple",
"RebeccaPurple",
"Plum",
"PaleVioletRed",
"OliveDrab",
"Navy",
"Orange",
"MediumVioletRed",
"Maroon",
"LimeGreen",
"LightCoral",
"Indigo",
"HotPink",
"IndianRed",
"GoldenRod",
"Green",
"DimGray",
"FireBrick",
"DeepPink",
"DarkSlateGrey",
"DarkOrange",
"Crimson",
"DarkKhaki",
"Brown",
"Chocolate",
"Black",
];

colorArray.forEach(element => {
var block = document.createElement("div");
block.classList.add("colorInstance");
block.style.backgroundColor = element ;
block.style.preventDeselect = "true";
block.setAttribute("title", element);
block.setAttribute("data-color", element);

//block.innerHTML = ('<div class="colorInstance" title="' + element + '" data-color="' + element + '" style="background-color: ' + element + ';"></div>');
var colopic = document.querySelector("#ColorPicker");
colopic.append(block);
});


var colorPixels = document.querySelectorAll(".colorInstance");


for (let i = 0; i < colorPixels.length; i++) {
colorPixels[i].addEventListener("click", function(e) {
  if (colorChangeMode == 0){
    selectedColor = colorPixels[i].getAttribute("data-color");
    var cc = document.querySelectorAll(".lup-colorpic");

    cc[0].style.backgroundColor = selectedColor;
    cc[0].style.filter = "invert(0)";
    var colopic = document.querySelector("#ColorPicker");
colopic.classList.add("d-none");
    return false;
  };
   });
}

</script>



    </div>

@endsection