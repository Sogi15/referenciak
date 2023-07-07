
// fuction a sliderek értékének a kiírásához a slider alatt
function SliderDownText(sliderId, sliderValueId, valueMap) {
  const slider = document.getElementById(sliderId);
  const sliderValue = document.getElementById(sliderValueId);

  // csúszka mozgatás (bevitel) során változzon a slider alatti div értéke
  slider.addEventListener("input", function () {
    const sliderVal = slider.value;
    sliderValue.textContent = valueMap[sliderVal] || "";
  });
}

// fuction a sliderek értékének a kiírásához a slider felett tooltip-ben
function SliderTooltip(sliderId, tooltipId, valueMap) {
  const slider = document.getElementById(sliderId);
  const tooltip = document.getElementById(tooltipId);
  slider.addEventListener("input", function () {
    const sliderVal = slider.value;
    tooltip.textContent = valueMap[sliderVal] || "";
  });
  // a sliderre mutatva írja ki a tooltipet benne az értékkel.
  slider.addEventListener("mousemove", function (e) {
    const sliderRect = slider.getBoundingClientRect();
    const tooltipWidth = tooltip.offsetWidth;
    const tooltipLeft = e.clientX - sliderRect.left - tooltipWidth / 2;
    tooltip.style.left = tooltipLeft + "px";
  });
}

// tömb az értékek tárolására
const sliderValues = {
  '0': "Nem tervez",
  '1': "0 - 500 000 Ft / hó",
  '2': "500 001 - 1 000 000 Ft / hó",
  '3': "1 000 001 - 3 000 000 Ft / hó",
  '4': "3 000 001 - 5 000 000 Ft / hó",
  '5': "5 000 001 - 8 000 000 Ft / hó",
  '6': "8 000 001 - 20 000 000 Ft / hó",
  '7': "100 000 000 Ft felett / hó",
};

// ciklus a sliderek használatához a funkctionok használatával.
for (let index = 0; index <= 7; index++) {
  SliderDownText("slider" + index, "slider" + index + "_v", sliderValues);
  SliderTooltip("slider" + index, "slider" + index + "t", sliderValues);
}