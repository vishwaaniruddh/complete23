Set objShell = CreateObject("WScript.Shell")
objShell.Run "powershell.exe -ExecutionPolicy Bypass -File ""C:\wamp64\www\healthStatusReport\cronJobs\runScript.ps1""", 0, False
Set objShell = Nothing
