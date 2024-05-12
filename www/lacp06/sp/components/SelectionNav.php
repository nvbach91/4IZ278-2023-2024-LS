<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <button class="selection-button" type="button" data-toggle="collapse" data-target="#navbarResponsive2" aria-controls="navbarResponsive2" aria-expanded="false" aria-label="Toggle navigation">MENU</button>
    <div class="collapse navbar-collapse" id="navbarResponsive2">
      <div class="selection-bar">
        <div class="selection-bar-item"><a href="">SVĚTY</a></div>
        <div class="selection-bar-item"><a href="">ŽÁNRY</a></div>
        <div class="selection-bar-item"><a href="">NAKLADATELSTVÍ</a></div>
        <div class="selection-bar-item"><a href="">NOVINKY</a></div>
      </div>
    </div>
  </div>
</nav>
<style lang="css">
  .selection-button {
    display: none;
    color: black;
    font-weight: bold;
    border: none;
    background-color: transparent;
    outline: none;
    width: 100%;

    @media (max-width: 992px) {
      display: block;
    }
  }

  .selection-bar {
    display: flex;
    width: 100%;
    justify-content: space-evenly;
    margin-left: auto;
    margin-right: auto;
    flex-direction: row;
    background-color: white;
    height: 64px;
    border-bottom: 3px red solid;

    @media (max-width: 992px) {
      flex-direction: column;
      height: fit-content;
    }
  }

  .selection-bar-item {
    display: flex;
    height: 100%;
    font-weight: bold;
    width: fit-content;
    justify-content: center;
    align-items: center;
  }
</style>