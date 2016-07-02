package moreco.eas.evolable.asia.moreco.database;

import io.realm.RealmObject;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class DictSentenceDataModel extends RealmObject {
    private int id;
    private int data_status;


    public int getSentenceId() {
        return id;
    }

    public void setSentenceId(int sentenceId) {
        this.id = sentenceId;
    }

    public int getData_status() {
        return data_status;
    }

    public void setData_status(int data_status){
        this.data_status = data_status;
    }
}
