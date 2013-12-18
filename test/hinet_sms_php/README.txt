本範例程式預設使用BIG5編碼發送簡訊，若有需要使用UTF-8或是UCS-2（UTF-16BE）編碼發送，
可將檔案 "[UTF-8]sms2.inc" 或是 "[UCS-2]sms2.inc" 更名成 "sms2.inc" 。但建議使用UCS-2，
因為以中文字為例，UCS-2編碼每個字佔 2 bytes，而UTF-8編碼則佔了 3 bytes 不等，亦即每則
簡訊使用BIG5及UCS-2編碼，可有70字，但使用UTF-8編碼則只剩下50多字。
