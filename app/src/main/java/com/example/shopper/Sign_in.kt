package com.example.shopper

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley

class Sign_in : AppCompatActivity() {






    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_sign_in)

        val regi_btn = findViewById<Button>(R.id.regi_btn)
        var mobile = findViewById<EditText>(R.id.mobile)
        var email = findViewById<EditText>(R.id.email)
        var name = findViewById<EditText>(R.id.username)
        var password = findViewById<EditText>(R.id.password)
        var Con_password = findViewById<EditText>(R.id.Con_password)

        regi_btn.setOnClickListener {

            val username:String = name.text.toString()
            val mail:String = email.text.toString()
            val phone:String = mobile.text.toString()
            val Password:String = password.text.toString()
            val Con_Password:String = Con_password.text.toString()

            if(Password.equals(Con_Password))
            {
               register(username, mail,phone,Password)
            }
            else{
                Toast.makeText(this,"Passwords do not match", Toast.LENGTH_LONG).show()
            }

        }

    }

    private fun register(username: String, mail: String, phone: String, password: String) {
        val url = "http://192.168.105.4/services/registration.php"

        val rq: RequestQueue=Volley.newRequestQueue(this)
        val sr:StringRequest= object : StringRequest(Request.Method.GET,url,Response.Listener { response ->
            if(response.equals("Registration is Successful"))
                Toast.makeText(this,"Registration is Successful",Toast.LENGTH_LONG).show()
//            else(response.equals("Email Already Exist"))
//                Toast.makeText(this,"User Already exists",Toast.LENGTH_LONG).show()
//            Log.d(TAG, "onCreate: Response")
        }
            ,Response.ErrorListener { error ->
                Toast.makeText(this,error.message,Toast.LENGTH_LONG).show()
            })

        {
            override fun getParams(): MutableMap<String, String>{

                val map = HashMap<String, String>()
                map.put("username", username)
                map.put("email", mail)
                map.put("mobile", phone.toString())
                map.put("password", password)

                return map
            }

        }
        rq.add(sr)

    }


}



