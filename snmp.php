<?php
class Yazici
{
	const yazici_uptime		="iso.3.6.1.2.1.1.3.0";
	const yazici_seri		="iso.3.6.1.2.1.43.5.1.1.17.1";
	const yazici_count		="iso.3.6.1.2.1.43.10.2.1.4.1.1";
	const yazici_toner		="iso.3.6.1.2.1.43.11.1.1.6.1.1";
	const yazici_host		="iso.3.6.1.4.1.1347.40.10.1.1.5.1";
	const yazici_adi		="iso.3.6.1.2.1.25.3.2.1.3.1";
	
	const bos_deger			="Deger_donmedi";
	
	protected $ip=null;
	
	
	public function __construct($ip=null){
			if($ip !=null && is_string($ip)){
				$this->setIp($ip);
			}
	}

	
	public function setIp($ip){
		if (preg_match("/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/", $ip)) {
            $this->ip = $ip;
        } else {
            throw new Exception($ip . ' Gecersiz ip adresi !');
        }
	}
	/*
	yazicinin acik kalma süresini verir.
	*/
	public function uptime(){
		return $this->_getSNMP(self::yazici_uptime);
	}
	
	/*
	yazicinin seri numarasını verir.
	*/
	public function seri(){
		return $this->_getSNMP(self::yazici_seri);
	}
	/*
	yazici adini verir.
	*/
	public function ad(){
		return $this->_getSNMP(self::yazici_adi);
	}
	/*
	alinan cıktı sayısını verir.
	*/
	public function sayfa_sayisi(){
		return $this->_getSNMP(self::yazici_count);
	}
	
	/*
	yazici tonerini verir.
	*/
	public function toner(){
		return $this->_getSNMP(self::yazici_toner);
	}
	/*
	yazicinin host adını verir.
	*/
	public function host(){
		return $this->_getSNMP(self::yazici_host);
	}
	
	private function _getSNMP($snmpID)
    {
        if ($this->ip == null) {
            throw new Exception('ip adresi bos');
        }

        $snmpcikti = @snmpget($this->ip, 'public', $snmpID);
        return $this->_filtrele($snmpcikti) != ''
                ? $this->_filtrele($snmpcikti) : self::bos_deger;
    }
	
	
	 private function _filtrele($cikti)
    {
        $temizle = array(
            'STRING: ',
            'INTEGER: ',
			'Timeticks:',
			'Counter32:',
            '"'
        );
		
        $cikti= trim(str_replace($temizle, '', $cikti));
		if ($cikti=preg_replace("/^[(]+[0-9]+[)]/","",$cikti)){
		}
        return $cikti;
    }
}
?>

