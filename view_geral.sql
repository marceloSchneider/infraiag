CREATE VIEW view_geral AS (
SELECT	bloco.nome bloco,
	bloco.id bloco_id,
	pavimento.nome andar,
	pavimento.id pavimento_id,
	sala.numero sala,
	sala.id sala_id,
	CONCAT(pavimento_rack.nome, rack.identificacao, '-', patch.pilha, '-', porta.numero) ponto,
	patch.pilha patch,
	patch.id patch_id, 
	IF(porta.porta_switch_id='NULL', 'A', 'NA') status,
	porta.id porta_id,
	voiceporta.ramal telefonia,
	voiceporta.id voiceporta_id,
	voiceporta.numero numVoicePanel,
	voiceporta.central central,
	voiceporta.distribuicao distribuicao,
	switchcommon.hostname nomeSwitch,
	switch.id switch_id,
	ipswitch.endereco ip,
	switchcommon.id ipswitch_id,
	portaswitch.num_porta porta,
	portaswitch.id portaswitch_id,
	porta.isWireless wireless,
	porta.isIpCamera ipCamera,
	GROUP_CONCAT(vlan.endereco SEPARATOR '\n') vlan,
	vlan.id vlan_id,
	sala_rack.numero salaRack,
	sala_rack.id sala_rack_id,
	switch.identificacao idSwitch
	

FROM
	PPorta porta

INNER JOIN	Sala AS sala ON sala.id = porta.sala_id
INNER JOIN	Pavimento AS pavimento ON pavimento.id = sala.pavimento_id
INNER JOIN 	Bloco AS bloco ON bloco.id = pavimento.bloco_id
LEFT JOIN	Patch AS patch ON patch.id = porta.patch_id
LEFT JOIN	VoicePorta AS voiceporta ON voiceporta.pporta_id = porta.id
LEFT JOIN	PortaSwitch AS portaswitch ON portaswitch.id = porta.porta_switch_id
LEFT JOIN	Switchs AS switch ON switch.id = portaswitch.switch_id
LEFT JOIN	SwitchCommon AS switchcommon ON switchcommon.id = switch.switch_common_id
INNER JOIN 	Rack AS rack ON rack.id = patch.rack_id
INNER JOIN 	Sala AS sala_rack ON sala_rack.id = rack.sala_id
INNER JOIN 	Pavimento AS pavimento_rack ON pavimento_rack.id = sala_rack.pavimento_id
LEFT JOIN	Ip AS ipswitch ON ipswitch.id = switchcommon.ip_id
LEFT JOIN	portaswitch_vlan AS p_v ON p_v.portaswitch_id = portaswitch.id
LEFT JOIN 	Vlan AS vlan ON vlan.id = p_v.vlan_id

GROUP BY porta.numero, patch.pilha, rack.identificacao
ORDER BY bloco.nome, sala.numero
	
);
