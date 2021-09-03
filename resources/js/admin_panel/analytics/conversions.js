export default function setConversionStats(conversions) {

    const whatsappConversions = document.getElementById('whatsappConversion');
    const callConversions = document.getElementById('callConversion');
    const contactConversions = document.getElementById('contactConversion');

    whatsappConversions.innerText = conversions['ga:goal1Completions'];
    callConversions.innerText = conversions['ga:goal2Completions'];
    contactConversions.innerText = conversions['ga:goal3Completions'];
}
