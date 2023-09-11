# eye-able-oxid-module


Check Out the differnet branches for the different Versions!

Install via composer: 
 ```
   cd <shopRoot>
   composer require eyeable/eye-able-oxid
```

How to Use: 
1. Clone Repo into the modules directory of your oxid shop. The keep the provided folder structure:
 ```
   cd <shopRoot>
  git clone https://github.com/Tobias-Eye-Able/eye-able-oxid-modules.git source/dev-packages/EyeAble/EyeAbleAssist --branch=b-7.0.x
```
2. Install Module from local path:
     ```
   cd <shopRoot>
     composer config repositories.eyeable/eye-able-oxid path source/dev-packages/EyeAble/EyeAbleAssist
     composer require eyeable/eye-able-oxid:*
     ```
**Important** <br> 
The module only works when a config file is provided. For getting a Config File you have to contact -> info@eye-able.com . If you do not have one, the Eye-Able Assist Module will not work.
   
