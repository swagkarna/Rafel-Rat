<p align="center">
  <img width="250" height="250" src="https://media.tenor.com/images/2c3668f83f251c47fe4319ed58961898/tenor.gif">
</p>
<p align="center"><img src="https://img.shields.io/badge/Version-1.0-brightgreen"></p>

</p> 
<p align="center"><img src="https://img.shields.io/badge/Author-Swagkarna-red.svg"> 
</p>


<p align="center">
   
  <img alt="GitHub followers" src="https://img.shields.io/github/followers/swagkarna?label=Follow&style=social">
   <a href="https://github.com/swagkarna/Rafel-Rat/stargazers">
    <img src="https://img.shields.io/github/stars/swagkarna/Rafel-Rat?style=social">
  </a>

</p>

<p align="center">
 Rafel is Remote Access Tool Used to Control Victims Using WebPanel With More Advance Features.
</p>

---
### Main Features 
- [X] Admin Permission
- [X] Add App To White List
- [X] Runs In Background
- [X] Looks Like Browser
- [X] Accessibility Feature
- [X] Support Android v5 - v10
- [X] No Port Forwarding Needed

### Prerequisites 
 - Android Studio
 <p align="center">
  <b> OR </b>
  </p>
  
- ApkEasyTool 
   -Click [Here](https://forum.xda-developers.com/android/software-hacking/tool-apk-easy-tool-v1-02-windows-gui-t3333960) to download
---  
### Building Apk With Android Studio

1. Open Project ***Lite_Browsercode*** in Android Studio 
2.  Write the ip address of the server where you run this project in the SERVER_URI section in the InternalService.class class
3.  Now Build the Project
4.  Now Zipalign and sign the Apk...
---
### Building Apk with ApkEasyTool 

1. Navigate to ***\Lite_Browser\smali\com\velociraptor\raptor*** 
2. Now Open InternalService.smali 
3. Now change this with your Panel Url ***const-string v0, "https://your-webpanel-url/commands.php"***
---
### Building Server 
1. Upload Files in server Folder to Your HostingPanel
2. Now Open login.php 
3. Enter Username ***Hande*** Password ***Ercel***
4. Booom !!!! Thats it
5. Note : Make Sure your webhosting site uses Https
