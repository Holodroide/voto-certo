using UnityEngine;
using System.Collections;
using UnityEngine.UI;

public class LoginManager : MonoBehaviour {



	[SerializeField]
	private InputField usuarioField = null;
	[SerializeField]
	private InputField senhaField = null;
	[SerializeField]
	private Text feedbackmsg = null;
	[SerializeField]
	private Toggle rememberData = null;

	private string url = "https://www.holodroide.com/sistema/usuario/loginapp.php";


	void Start () {
		if(PlayerPrefs.HasKey("lembra") && PlayerPrefs.GetInt("lembra") == 1) {
			usuarioField.text = PlayerPrefs.GetString("rememberUser");
			senhaField.text = PlayerPrefs.GetString("rememberSenha");
		}
	}
	

	public void FazerLogin () {
		if (usuarioField.text == "" || senhaField.text == "") {
			FeedBackError ("Preencha todos os campos");
		} else {
			string usuario = usuarioField.text;
			string senha = senhaField.text;

			if (rememberData.isOn) {
				PlayerPrefs.SetInt ("lembra", 1);
				PlayerPrefs.SetString ("rememberUser", usuario);
				PlayerPrefs.SetString ("rememberSenha", senha);
			}

			WWW www = new WWW (url + "?login=" + usuario + "&senha=" +senha);
			// Acima quer dizer: https://www.holodroide.com/sistema/usuario/loginapp.php?login=xxxx&senha=xxxx
			StartCoroutine(ValidaLogin(www));
		}
	}

	IEnumerator ValidaLogin (WWW www){
		yield return www;
		if (www.error == null) {
			if (www.text == "1") {
				FeedBackOk ("Login realizado com sucesso\nCarregando sistema...");
				StartCoroutine (CarregaScene ());
			} else {
				FeedBackError("Usuário ou Senha inválidos!");

			}
		} else {
			if (www.error == "couldn't connect to host") {
				FeedBackError ("Servidor indisponível");
			}
		}
	}


	IEnumerator CarregaScene () {
		yield return new WaitForSeconds (2);
		Application.LoadLevel ("logado");
		//SceneManager.LoadScene ("logado");
	}

	void FeedBackOk(string mensagem){
		feedbackmsg.CrossFadeAlpha (100f, 0f, false);
		feedbackmsg.color = Color.green;
		feedbackmsg.text = mensagem;
	}

	void FeedBackError(string mensagem){
		feedbackmsg.CrossFadeAlpha (100f, 1f, false);
		feedbackmsg.color = Color.red;
		feedbackmsg.text = mensagem;
		feedbackmsg.CrossFadeAlpha (0f, 2f, false);
		usuarioField.text = "";
		senhaField.text = "";
	}
}
	