<?php
include_once(dirname(__FILE__).'/../../Protocols/EPP/eppConnection.php');
include_once(dirname(__FILE__).'/../../Protocols/EPP/eppRequests/eppIncludes.php');
include_once(dirname(__FILE__).'/../../Protocols/EPP/eppResponses/eppIncludes.php');
include_once(dirname(__FILE__).'/../../Protocols/EPP/eppData/eppIncludes.php');

#
# Load the DNSBE specific additions
#
include_once(dirname(__FILE__).'/dnsbeEppCreateRequest.php');
include_once(dirname(__FILE__).'/dnsbeEppCreateResponse.php');
include_once(dirname(__FILE__).'/dnsbeEppCreateNsgroupRequest.php');
include_once(dirname(__FILE__).'/dnsbeEppCreateNsgroupResponse.php');
include_once(dirname(__FILE__).'/dnsbeEppAuthcodeRequest.php');
include_once(dirname(__FILE__).'/dnsbeEppInfoDomainRequest.php');
include_once(dirname(__FILE__).'/dnsbeEppInfoDomainResponse.php');
include_once(dirname(__FILE__).'/dnsbeEppTransferRequest.php');

class dnsbeEppConnection extends eppConnection
{

    public function __construct()
    {
        parent::__construct(false);
        parent::setHostname('ssl://epp.registry.tryout.dns.be');
        parent::setPort('33128');
        parent::setUsername('');
        parent::setPassword('');
        parent::setTimeout(5);
        parent::setLanguage('en');
        parent::setVersion('1.0');
        parent::addExtension('http://www.dns.be/xml/epp/nsgroup-1.0','nsgroup');
        parent::addExtension('http://www.dns.be/xml/epp/registrar-1.0','registrar');
        parent::addExtension('http://www.dns.be/xml/epp/dnsbe-1.0','dnsbe');
        parent::enableDnssec();
        #parent::addExtension('urn:ietf:params:xml:ns:secDNS-1.1','secDNS');
        #parent::addExtension('keygroup','http://www.dns.be/xml/epp/keygroup-1.0');
        parent::addCommandResponse('dnsbeEppCreateNsgroupRequest', 'dnsbeEppCreateNsgroupResponse');
        parent::addCommandResponse('dnsbeEppCreateRequest', 'dnsbeEppCreateResponse');
        parent::addCommandResponse('dnsbeEppAuthcodeRequest', 'eppResponse');
        parent::addCommandResponse('dnsbeEppInfoDomainRequest', 'dnsbeEppInfoDomainResponse');
        #parent::addCommandResponse('dnsbeEppCreateRequest', 'eppCreateResponse');
        #parent::addCommandResponse('eppCheckRequest', 'dnsbeEppCheckResponse');
    }

}
