<?php
// config/domain.php
return [
    'second_level_domains' => [
        // Domínios de topo mais comuns
        'com', 'org', 'net', 'info', 'biz', 'edu', 'gov', 'mil', 'int', 'name', 'pro', 'aero', 'museum', 'coop',
        
        // Domínios de país (ccTLDs)
        'us', 'uk', 'ca', 'de', 'fr', 'jp', 'au', 'it', 'nl', 'se', 'ch', 'be', 'at', 'dk', 'no', 'fi', 'es', 'pl', 'ru', 'br', 'mx', 'in', 'za', 'kr', 'tw', 'hk', 'sg', 'my', 'id', 'ph', 'th', 'vn', 'cl', 'co', 'ar', 'pe', 'uy', 'py', 'bo', 'ec', 'do', 'cr', 'gt', 'hn', 'ni', 'sv', 'pa', 'jm', 'bb', 'ag', 'tn', 'ma', 'dz', 'ly', 'eg',
        
        // Domínios adicionais
        'ae', 'sa', 'qa', 'kw', 'om', 'jo', 'il', 'ps', 'cn', 'hk', 'mo', 'tw', 'kp', 'bd', 'lk', 'np', 'pk', 'af', 'mm', 'la', 'kh', 'mn', 'ws', 'tv', 'to', 'vu', 'fm', 'mh', 'ki', 'tv', 'sb', 'vu',
        
        // Domínios de segundo nível para países (exemplos de variações)
        'com.br', 'net.br', 'org.br', 'edu.br', 'gov.br', 'mil.br', 'info.br', 'blog.br',
        'com.au', 'net.au', 'org.au', 'edu.au', 'gov.au', 'asn.au', 'id.au',
        'com.ca', 'net.ca', 'org.ca', 'edu.ca', 'gov.ca',
        'com.cn', 'net.cn', 'org.cn', 'edu.cn', 'gov.cn',
        'com.fr', 'net.fr', 'org.fr', 'edu.fr', 'gov.fr',
        'com.de', 'net.de', 'org.de', 'edu.de', 'gov.de',
        'com.it', 'net.it', 'org.it', 'edu.it', 'gov.it',
        'com.nl', 'net.nl', 'org.nl', 'edu.nl', 'gov.nl',
        'com.se', 'net.se', 'org.se', 'edu.se', 'gov.se',
        'com.ch', 'net.ch', 'org.ch', 'edu.ch', 'gov.ch',
        'com.be', 'net.be', 'org.be', 'edu.be', 'gov.be',
        'com.at', 'net.at', 'org.at', 'edu.at', 'gov.at',
        'com.dk', 'net.dk', 'org.dk', 'edu.dk', 'gov.dk',
        'com.no', 'net.no', 'org.no', 'edu.no', 'gov.no',
        'com.fi', 'net.fi', 'org.fi', 'edu.fi', 'gov.fi',
        'com.es', 'net.es', 'org.es', 'edu.es', 'gov.es',
        'com.pl', 'net.pl', 'org.pl', 'edu.pl', 'gov.pl',
        'com.ru', 'net.ru', 'org.ru', 'edu.ru', 'gov.ru',
        'com.mx', 'net.mx', 'org.mx', 'edu.mx', 'gov.mx',
        'com.ar', 'net.ar', 'org.ar', 'edu.ar', 'gov.ar',
        'com.pe', 'net.pe', 'org.pe', 'edu.pe', 'gov.pe',
        'com.uy', 'net.uy', 'org.uy', 'edu.uy', 'gov.uy',
        'com.py', 'net.py', 'org.py', 'edu.py', 'gov.py',
        'com.bo', 'net.bo', 'org.bo', 'edu.bo', 'gov.bo',
        'com.ve', 'net.ve', 'org.ve', 'edu.ve', 'gov.ve',
        'com.ec', 'net.ec', 'org.ec', 'edu.ec', 'gov.ec',
        'com.do', 'net.do', 'org.do', 'edu.do', 'gov.do',
        'com.cr', 'net.cr', 'org.cr', 'edu.cr', 'gov.cr',
        'com.gt', 'net.gt', 'org.gt', 'edu.gt', 'gov.gt',
        'com.hn', 'net.hn', 'org.hn', 'edu.hn', 'gov.hn',
        'com.ni', 'net.ni', 'org.ni', 'edu.ni', 'gov.ni',
        'com.sv', 'net.sv', 'org.sv', 'edu.sv', 'gov.sv',
        'com.pa', 'net.pa', 'org.pa', 'edu.pa', 'gov.pa',
        'com.jm', 'net.jm', 'org.jm', 'edu.jm', 'gov.jm',
        'com.bb', 'net.bb', 'org.bb', 'edu.bb', 'gov.bb',
        'com.ag', 'net.ag', 'org.ag', 'edu.ag', 'gov.ag',
        'com.tn', 'net.tn', 'org.tn', 'edu.tn', 'gov.tn',
        'com.ma', 'net.ma', 'org.ma', 'edu.ma', 'gov.ma',
        'com.dz', 'net.dz', 'org.dz', 'edu.dz', 'gov.dz',
        'com.ly', 'net.ly', 'org.ly', 'edu.ly', 'gov.ly',
        'com.eg', 'net.eg', 'org.eg', 'edu.eg', 'gov.eg',
        'com.ae', 'net.ae', 'org.ae', 'edu.ae', 'gov.ae',
        'com.sa', 'net.sa', 'org.sa', 'edu.sa', 'gov.sa',
        'com.qa', 'net.qa', 'org.qa', 'edu.qa', 'gov.qa',
        'com.kw', 'net.kw', 'org.kw', 'edu.kw', 'gov.kw',
        'com.om', 'net.om', 'org.om', 'edu.om', 'gov.om',
        'com.jo', 'net.jo', 'org.jo', 'edu.jo', 'gov.jo',
        'com.il', 'net.il', 'org.il', 'edu.il', 'gov.il',
        'com.ps', 'net.ps', 'org.ps', 'edu.ps', 'gov.ps',
        'com.bd', 'net.bd', 'org.bd', 'edu.bd', 'gov.bd',
        'com.lk', 'net.lk', 'org.lk', 'edu.lk', 'gov.lk',
        'com.np', 'net.np', 'org.np', 'edu.np', 'gov.np',
        'com.pk', 'net.pk', 'org.pk', 'edu.pk', 'gov.pk',
        'com.af', 'net.af', 'org.af', 'edu.af', 'gov.af',
        'com.mm', 'net.mm', 'org.mm', 'edu.mm', 'gov.mm',
        'com.la', 'net.la', 'org.la', 'edu.la', 'gov.la',
        'com.kh', 'net.kh', 'org.kh', 'edu.kh', 'gov.kh',
        'com.mn', 'net.mn', 'org.mn', 'edu.mn', 'gov.mn',
        'com.ws', 'net.ws', 'org.ws', 'edu.ws', 'gov.ws',
        'com.tv', 'net.tv', 'org.tv', 'edu.tv', 'gov.tv',
        'com.to', 'net.to', 'org.to', 'edu.to', 'gov.to',
        'com.vu', 'net.vu', 'org.vu', 'edu.vu', 'gov.vu',
        'com.fm', 'net.fm', 'org.fm', 'edu.fm', 'gov.fm',
        'com.mh', 'net.mh', 'org.mh', 'edu.mh', 'gov.mh',
        'com.ki', 'net.ki', 'org.ki', 'edu.ki', 'gov.ki',
        'com.sb', 'net.sb', 'org.sb', 'edu.sb', 'gov.sb',
        'com.vu', 'net.vu', 'org.vu', 'edu.vu', 'gov.vu',
        'com.cu', 'net.cu', 'org.cu', 'edu.cu', 'gov.cu', // Cuba
        'com.ge', 'net.ge', 'org.ge', 'edu.ge', 'gov.ge', // Geórgia
        'com.by', 'net.by', 'org.by', 'edu.by', 'gov.by', // Bielorrússia
        'com.md', 'net.md', 'org.md', 'edu.md', 'gov.md', // Moldávia
        'com.kz', 'net.kz', 'org.kz', 'edu.kz', 'gov.kz', // Cazaquistão
        'com.ua', 'net.ua', 'org.ua', 'edu.ua', 'gov.ua', // Ucrânia
        'com.rs', 'net.rs', 'org.rs', 'edu.rs', 'gov.rs', // Sérvia
        'com.mk', 'net.mk', 'org.mk', 'edu.mk', 'gov.mk', // Macedônia do Norte
        'com.lk', 'net.lk', 'org.lk', 'edu.lk', 'gov.lk', // Sri Lanka
        'com.et', 'net.et', 'org.et', 'edu.et', 'gov.et', // Etiópia
        'com.ma', 'net.ma', 'org.ma', 'edu.ma', 'gov.ma', // Marrocos
        'com.ly', 'net.ly', 'org.ly', 'edu.ly', 'gov.ly', // Líbia
        'com.ng', 'net.ng', 'org.ng', 'edu.ng', 'gov.ng', // Nigéria
        'com.gn', 'net.gn', 'org.gn', 'edu.gn', 'gov.gn', // Guiné
        'com.lr', 'net.lr', 'org.lr', 'edu.lr', 'gov.lr', // Libéria
        'com.sn', 'net.sn', 'org.sn', 'edu.sn', 'gov.sn', // Senegal
        'com.ci', 'net.ci', 'org.ci', 'edu.ci', 'gov.ci', // Costa do Marfim
        'com.dj', 'net.dj', 'org.dj', 'edu.dj', 'gov.dj', // Djibuti
        'com.so', 'net.so', 'org.so', 'edu.so', 'gov.so', // Somália
        'com.mu', 'net.mu', 'org.mu', 'edu.mu', 'gov.mu', // Maurício
        'com.mz', 'net.mz', 'org.mz', 'edu.mz', 'gov.mz', // Moçambique
        'com.zm', 'net.zm', 'org.zm', 'edu.zm', 'gov.zm', // Zâmbia
        'com.zw', 'net.zw', 'org.zw', 'edu.zw', 'gov.zw', // Zimbábue
        'com.tz', 'net.tz', 'org.tz', 'edu.tz', 'gov.tz', // Tanzânia
        'com.rw', 'net.rw', 'org.rw', 'edu.rw', 'gov.rw', // Ruanda
        'com.bw', 'net.bw', 'org.bw', 'edu.bw', 'gov.bw', // Botsuana
        'com.sz', 'net.sz', 'org.sz', 'edu.sz', 'gov.sz', // Suazilândia
        'com.ws', 'net.ws', 'org.ws', 'edu.ws', 'gov.ws', // Samoa Ocidental
        'com.as', 'net.as', 'org.as', 'edu.as', 'gov.as', // Samoa Americana
        'com.tc', 'net.tc', 'org.tc', 'edu.tc', 'gov.tc', // Ilhas Turcas e Caicos
        'com.ai', 'net.ai', 'org.ai', 'edu.ai', 'gov.ai', // Anguila
        'com.ms', 'net.ms', 'org.ms', 'edu.ms', 'gov.ms', // Montserrat
        'com.bm', 'net.bm', 'org.bm', 'edu.bm', 'gov.bm', // Bermudas
        'com.ai', 'net.ai', 'org.ai', 'edu.ai', 'gov.ai', // Anguila
        
        // Domínios regionais e especializados
        'cat', 'jobs', 'tel', 'travel', 'museum', 'coop', 'aero', 'int', 'pro',
        'xyz', 'club', 'online', 'site', 'tech', 'store', 'space', 'love',
        'vip', 'me', 'tv', 'ws', 'cc', 'io', 'name', 'co',
    ],
];