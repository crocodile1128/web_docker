#!/bin/bash
python -c "import re;import os;out=re.sub('(#SecAction[\S\s]*id:900000[\s\S]*paranoia_level=1\")','SecAction \\\\\n  \"id:900000, \\\\\n   phase:1, \\\\\n   nolog, \\\\\n   pass, \\\\\n   t:none, \\\\\n   setvar:tx.paranoia_level='+os.environ['PARANOIA']+'\"',open('/etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/crs-setup.conf','r').read());open('/etc/nginx/modsecurity.d/owasp-modsecurity-crs-3.2/crs-setup.conf','w').write(out)" && \

exec "$@"
