package com.lab9v1.view;

import com.lab9v1.controller.MainController;
import com.lab9v1.model.*;
import com.lab9v1.view.chart.Chart;

import javax.swing.*;
import javax.swing.event.*;
import javax.swing.text.NumberFormatter;
import java.awt.event.*;
import java.text.DecimalFormat;
import java.util.ArrayList;

public class App implements DocumentObserver {
    private JButton addNewButton;
    private JButton deleteSelectedButton;
    private JFormattedTextField amplitudeTextField;
    private JList harmonicsList;
    private JTabbedPane tabbedPane;
    private JTable table;
    private JRadioButton sinRadioButton;
    private JRadioButton cosRadioButton;
    private JFormattedTextField frequencyTextField;
    private JFormattedTextField phaseTextField;
    private JPanel mainPanel;
    private JPanel selectedHarmonicaPanel;
    private JPanel listPanel;
    private JPanel chartPanel;
    private ButtonGroup formulaButtonGroup;

    private final MainController controller;

    private int selectedHarmonicaIndex = -1;

    private double minX = 0;
    private double maxX = 8;
    private double delta = 0.5;

    private boolean listenChange = false;

    public App(MainController controller) {
        this.controller = controller;
        this.controller.getDocument().register(this);
        this.controller.getDocument().register((DocumentObserver) this.chartPanel);

        this.drawList();
        this.drawSelectedHarmonica();
        this.drawTable();

        this.bindBtnEvents();
        this.bindListEvents();
        this.bindChangeSelectedEvents();
    }

    public JPanel getMainPanel() {
        return mainPanel;
    }

    private void bindBtnEvents() {
        addNewButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddNewHarmonica();
            }
        });
        deleteSelectedButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                onDeleteSelectedButton();
            }
        });

    }

    private void bindListEvents () {
        harmonicsList.addListSelectionListener(new ListSelectionListener() {
            @Override
            public void valueChanged(ListSelectionEvent e) {
                int index = ((JList) e.getSource()).getSelectedIndex();
                if (index == selectedHarmonicaIndex) {
                    return;
                }
                selectedHarmonicaIndex = index;
                onSelectHarmonica();
            }
        });
    }

    private void bindChangeSelectedEvents() {
        DocumentListener listener = new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                onEditSelectedHarmonica();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                onEditSelectedHarmonica();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {

            }
        };

        amplitudeTextField.getDocument().addDocumentListener(listener);
        frequencyTextField.getDocument().addDocumentListener(listener);
        phaseTextField.getDocument().addDocumentListener(listener);

        sinRadioButton.addItemListener(new ItemListener() {
            @Override
            public void itemStateChanged(ItemEvent event) {
                onEditSelectedHarmonica();
            }
        });
        cosRadioButton.addItemListener(new ItemListener() {
            @Override
            public void itemStateChanged(ItemEvent event) {
                onEditSelectedHarmonica();
            }
        });
    }

     private void onDeleteSelectedButton() {
        this.controller.removeSelectedHarmonica();
     }

     private void drawTable() {
         HarmonicaTableModel dataModel = new HarmonicaTableModel((UnaryFunction) this.controller.getDocument(), minX, maxX, delta);
         this.table.setModel(dataModel);
     }

     private void drawList() {
         DefaultListModel data = new DefaultListModel();
         this.controller.getDocument().getHarmonics().forEach(harmonica -> {
             data.addElement(harmonica);
         });
         this.harmonicsList.setModel(data);
     }

     private void onSelectHarmonica() {
        if (!this.listenChange) return;
        this.listenChange = false;
        ImmutableHarmonica selected = (ImmutableHarmonica) this.harmonicsList.getSelectedValue();
        this.controller.setSelectedHarmonica(selected);
        this.listenChange = true;
     }

    private void drawSelectedHarmonica() {
        ImmutableHarmonica selected = this.controller.getSelectedHarmonica();
        if (selected != null) {
            setData(selected);
        } else {
            setDataNull();
        }
    }

    private void setData(ImmutableHarmonica data) {
        this.listenChange = false;
        if (this.isModified(data)) {
            amplitudeTextField.setValue(data.getAmplitude());
            frequencyTextField.setValue(data.getFrequency());
            phaseTextField.setValue(data.getPhase());
            formulaButtonGroup.clearSelection();
            switch (data.getFormula()) {
                case COS -> cosRadioButton.setSelected(true);
                case SIN -> sinRadioButton.setSelected(true);
            }
        }
        this.listenChange = true;
    }

    private void setDataNull() {
        this.listenChange = false;
        amplitudeTextField.setValue(0.0);
        frequencyTextField.setValue(0.0);
        phaseTextField.setValue(0.0);
        formulaButtonGroup.clearSelection();
        sinRadioButton.setSelected(true);
        this.listenChange = true;
    }

    private ImmutableHarmonica getData() {
        ImmutableHarmonica harmonica = new Harmonica(getAmplitude(), getFormula(), getFrequency(), getPhase());
        return harmonica;
    }

    public boolean isModified(ImmutableHarmonica data) {
        if (getAmplitude() != data.getAmplitude()) {
            return true;
        }
        if (getFrequency() != data.getFrequency()) {
            return true;
        }
        if (getPhase() != data.getPhase()) {
            return true;
        }
        if (getFormula() != data.getFormula()) {
            return true;
        }
        return false;
    }

    private double getAmplitude() {
        Object value = amplitudeTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    private Formula getFormula() {
        if (cosRadioButton.isSelected()) {
            return Formula.COS;
        } else {
            return Formula.SIN;
        }
    }

    private double getFrequency() {
        Object value = frequencyTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    private double getPhase() {
        Object value = phaseTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    @Override
    public void update() {
        this.drawList();
        this.drawSelectedHarmonica();
        this.drawTable();
    }

    private void onEditSelectedHarmonica() {
        if (!listenChange) return;
        listenChange = false;
        ImmutableHarmonica selected = this.controller.getSelectedHarmonica();
        if (selected != null && isModified(selected)) {
            ImmutableHarmonica newHarmonica = this.getData();
            this.controller.changeSelectedHarmonica(newHarmonica);
        }
        listenChange = true;
    }

    private void createUIComponents() {
        DecimalFormat format = new DecimalFormat("##0.0##");
        NumberFormatter formatter = new NumberFormatter(format);
        formatter.setAllowsInvalid(false);
        formatter.setValueClass(Double.class);

        this.frequencyTextField = new JFormattedTextField(formatter);
        this.amplitudeTextField = new JFormattedTextField(formatter);
        this.phaseTextField = new JFormattedTextField(formatter);

        ArrayList<UnaryFunction> unaryFunctionList = new ArrayList<UnaryFunction>();
        unaryFunctionList.add((UnaryFunction) this.controller.getDocument());

        this.chartPanel = new Chart(unaryFunctionList);
    }
}
