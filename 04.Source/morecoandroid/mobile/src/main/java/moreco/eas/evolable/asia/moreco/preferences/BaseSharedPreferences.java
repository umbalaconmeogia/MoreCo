package moreco.eas.evolable.asia.moreco.preferences;

import android.content.Context;
import android.content.SharedPreferences;

import moreco.eas.evolable.asia.moreco.R;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class BaseSharedPreferences {
    public SharedPreferences mSharedPref;
    public final static int DEFAULT_INT = 0;
    public final static String DEFAULT_STRING = "";
    public BaseSharedPreferences(Context context) {
        mSharedPref = context.getSharedPreferences(
                "MoreCo_SharedPreferences", Context.MODE_PRIVATE);
    }

    public void setInt(String key, int value){
        SharedPreferences.Editor editor = mSharedPref.edit();
        editor.putInt(key, value);
        editor.commit();
    }
    public int getInt (String key) {
        int value = mSharedPref.getInt(key, DEFAULT_INT);
        return value;
    }

    public void setString(String key, String value){
        SharedPreferences.Editor editor = mSharedPref.edit();
        editor.putString(key, value);
        editor.commit();
    }
    public String getString (String key) {
        String value = mSharedPref.getString(key, DEFAULT_STRING);
        return value;
    }

    public void setBoolean(String key, boolean value){
        SharedPreferences.Editor editor = mSharedPref.edit();
        editor.putBoolean(key, value);
        editor.commit();
    }
    public Boolean getBoolean (String key) {
        boolean value = mSharedPref.getBoolean(key, false);
        return value;
    }


}
